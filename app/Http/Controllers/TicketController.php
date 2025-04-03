<?php
namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TicketController extends Controller
{
    /**
     * Generate PDF ticket
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function generatePDF()
    {
        try {
            $flightData = session('flight_search.selected_flight');
            $passengers = session('flight_search.selected_flight.passengers');
            // dd(session('flight_search'));
            if (! $flightData || ! $passengers) {
                return response()->json([
                    'error' => 'Flight or passenger data not found',
                ], 404);
            }

            $data = $this->prepareTicketData($flightData, $passengers);

            $fileName = $this->generateFileName($data);

            $this->createTicketsDirectory();

            $pdf = $this->generateTicketPDF($data);
            // dd($pdf);
            $pdfPath = $this->saveTicketPDF($pdf, $fileName);

            // تحديث حالة التذكرة في قاعدة البيانات إذا لزم الأمر
            // $this->updateTicketStatus($ticketId, $pdfPath);

            return response()->json([
                'message'      => 'PDF Generated Successfully!',
                'path'         => asset('storage/' . $pdfPath),
                'filename'     => $fileName,
                'download_url' => route('tickets.download', $fileName),
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'error'   => 'Failed to generate PDF',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Prepare ticket data for PDF generation
     *
     * @param array $flightData
     * @param array $passengers
     * @return array
     */
    private function prepareTicketData($flightData, $passengers)
    {
        // dd(session('flight_search'));
        // استخراج معلومات الرحلة
        $departure = $selectedFlight['itineraries'][0]['segments'][0]['departure'] ?? [];
        $arrival   = $selectedFlight['itineraries'][0]['segments'][0]['arrival'] ?? [];

        return [
            'title'             => 'Flight Ticket',
            'booking_reference' => $selectedFlight['booking_reference'] ?? '',
            'flight_number'     => $selectedFlight['segments_info'][0]['flightNumber'] ?? '',
            'airline'           => $selectedFlight['segments_info'][0]['airline_info']['name'] ?? '',
            'departure'         => [
                'city'     => $departure['iataCode'] ?? '',
                'terminal' => $departure['terminal'] ?? '',
                'date'     => isset($departure['at']) ? date('Y-m-d', strtotime($departure['at'])) : '',
                'time'     => isset($departure['at']) ? date('H:i', strtotime($departure['at'])) : '',
            ],
            'arrival'           => [
                'city'     => $arrival['iataCode'] ?? '',
                'terminal' => $arrival['terminal'] ?? '',
                'date'     => isset($arrival['at']) ? date('Y-m-d', strtotime($arrival['at'])) : '',
                'time'     => isset($arrival['at']) ? date('H:i', strtotime($arrival['at'])) : '',
            ],
            'passengers'        => $passengers,
            'price'             => $selectedFlight['price']['grandTotal'] ?? '',
            'currency'          => $selectedFlight['price']['currency'] ?? 'USD',
            'cabin'             => session('flight_search.cabin') ?? '',
        ];
    }

    /**
     * Generate unique filename for the ticket
     *
     * @param array $data
     * @return string
     */
    private function generateFileName($data)
    {
        return sprintf(
            'ticket_%s_%s_%s.pdf',
            $data['booking_reference'],
            date('Ymd'),
            Str::random(4)
        );
    }

    /**
     * Create tickets directory if it doesn't exist
     *
     * @return void
     */
    private function createTicketsDirectory()
    {
        if (! Storage::disk('public')->exists('tickets')) {
            Storage::disk('public')->makeDirectory('tickets');
        }
    }

    /**
     * Generate PDF from view
     *
     * @param array $data
     * @return \Barryvdh\DomPDF\PDF
     */
    private function generateTicketPDF($data)
    {
        $pdf = PDF::loadView('tickets.tickets-pdf', $data);
        // return $pdf->download('flight-ticket.pdf');

        $pdf->setPaper('A4', 'portrait');
        $pdf->setOptions([
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled'      => true,
            'defaultFont'          => 'sans-serif',
        ]);

        return $pdf;
    }

    /**
     * Save PDF file to storage
     *
     * @param \Barryvdh\DomPDF\PDF $pdf
     * @param string $fileName
     * @return string
     */
    private function saveTicketPDF($pdf, $fileName)
    {
        $pdfPath = 'tickets/' . $fileName;
        Storage::disk('public')->put($pdfPath, $pdf->output());

        // dd($pdfPath);
        return $pdfPath;
    }

    /**
     * Download PDF ticket
     *
     * @param string $filename
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function downloadPDF($filename)
    {
        try {
            $path = storage_path('app/public/tickets/' . $filename);

            if (file_exists($path)) {
                return response()->download($path, $filename, [
                    'Content-Type'        => 'application/pdf',
                    'Content-Disposition' => 'attachment; filename="' . $filename . '"',
                ]);
            }

            return response()->json([
                'error' => 'File not found',
            ], 404);
        } catch (Exception $e) {
            return response()->json([
                'error'   => 'Download failed',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

}