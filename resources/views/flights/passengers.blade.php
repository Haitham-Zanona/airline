<x-front-layout>

    <style>
        .progress-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #15406a;
            padding: 15px;
            color: white;
            font-weight: bold;
            position: relative;
        }

        .progress-container .step {
            position: relative;
            text-align: center;
            flex-grow: 1;
        }

        .progress-container .step::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            width: 100%;
            height: 4px;
            background-color: #f0ad4e;
            transform: translateY(-50%);
            z-index: -1;
        }

        .progress-container .step:first-child::before {
            width: 50%;
            left: 50%;
        }

        .progress-container .step:last-child::before {
            width: 50%;
        }

        .progress-container .circle {
            width: 30px;
            height: 30px;
            line-height: 30px;
            border-radius: 50%;
            background-color: white;
            color: black;
            display: inline-block;
            font-weight: bold;
        }

        .progress-container .active .circle {
            background-color: #f0ad4e;
            color: white;
        }

        .progress-container .completed .circle {
            background-color: #28a745;
            color: white;
        }
    </style>



    <div class="progress-container">
        <div class="step completed">
            <span class="circle">1</span>
            <p>SEARCH RESULT</p>
        </div>
        <div class="step active">
            <span class="circle">2</span>
            <p>PASSENGER</p>
        </div>
        <div class="step">
            <span class="circle">3</span>
            <p>PAYMENT</p>
        </div>
        <div class="step">
            <span class="circle">4</span>
            <p>CONFIRM</p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-9 d-flex align-items-center">
            <div class="mx-2 d-inline-block">
                <img src="{{ asset('assets/images/shield.jpg') }}" class="m-0" height="50" width="50" alt="lock">
            </div>
            <div class="my-3 d-inline-block" style="color: #15406a;">
                <h4 class="m-0 p-0">Secure Booking</h4>
                <p class="m-0">We use secure transmission and encrypted storage to protect your personal information!
                </p>
            </div>
        </div><!-- col-md-9 -->

        <div class="col-md-3 d-flex align-items-center">
            <div class="mx-2 d-inline-block">
                <img src="{{ asset('assets/images/call.jpg') }}" class="m-0" height="50" width="50" alt="lock">
            </div>
            <div class="my-3 d-inline-block" style="color: #15406a;">
                <p class="m-0 p-0">Need Any Help?</p>
                <p class="m-0">Call Now +1-877-847-4278</p>
            </div>
        </div><!-- col-md-3 -->
    </div><!-- row -->

    <div class="row px-3">
        <div class="col-md-9">
            <div>
                <div>
                    <h3>Selected Flight</h3>
                </div>
                <div class="text-white py-1 px-2 " style="background-color: #15406a;">
                    <div class="outbound-flight d-flex justify-content-between">
                        <div class="outbound-flight">
                            <img src="" alt="alter" class="d-inline-block">
                            <h5 class="m-0 d-inline-block">Outbound Flight</h5>
                        </div>
                        <p class="m-0 text-right ">Non stop</p>
                    </div>
                </div>

            </div>
        </div><!-- col-md-9 -->
        <div class="col-md-3"></div><!-- col-md-3 -->
    </div><!-- row -->

    <script>
        function updateProgress(currentStep) {
            const steps = document.querySelectorAll('.step');
            steps.forEach((step, index) => {
                if (index + 1 < currentStep) {
                    step.classList.add('completed');
                    step.classList.remove('active');
                } else if (index + 1 === currentStep) {
                    step.classList.add('active');
                } else {
                    step.classList.remove('active', 'completed');
                }
            });
        }

        // قم بتحديث الخطوة بناءً على المرحلة الحالية
        updateProgress(2); // غيّر الرقم حسب الخطوة الحالية
    </script>


</x-front-layout>
