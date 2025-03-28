<?php
// في app/Services/AirlineLogoService.php
namespace App\Services;

class AirlineLogoService
{
    public static function getLogoUrl($airlineName)
    {
        // معالجة الاسم للتأكد من صحته
        $logoName = strtolower(str_replace([' ', '&', '/'], ['-', 'and', '-'], trim($airlineName)));
        // dd($logoName);

        // قائمة بروابط محددة لبعض شركات الطيران
        $specialLogos = [
            'royal-jordanian' => 'https://cdn.flightaware.com/assets/airlines/logotypes/royal-jordanian-logo.png',
            'emirates'        => 'https://cdn.flightaware.com/assets/airlines/logotypes/emirates-logo.png',
            // أضف المزيد حسب الحاجة
        ];

        // التحقق من وجود رابط خاص
        if (isset($specialLogos[$logoName])) {
            return $specialLogos[$logoName];
        }

        // الرابط الافتراضي
        // dd("https://pics.avs.io/200/200/" . urlencode($logoName) . "-logo" . ".png");
        return "https://pics.avs.io/200/200/" . urlencode($logoName) . ".png";
    }

    public static function getDefaultLogo()
    {
        return '/images/default-airline-logo.png'; // أضف صورة افتراضية
    }
}