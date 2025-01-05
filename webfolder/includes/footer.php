<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Footer with SVG Logo</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Plus Jakarta Sans Font -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Footer Section -->
    <footer class="mt-10 text-white py-2 relative">
    <div class="absolute inset-0 -z-10">
        <svg width="full" height="auto" viewBox="0 0 1440 390" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-100%">
            <!-- SVG content -->
                <path d="M206 25C206 11.1929 194.807 0 181 0H63C49.1929 0 38 11.1929 38 25V48C38 52.4183 34.4183 56 30 56H0V390H1440V56H214C209.582 56 206 52.4183 206 48V25Z" fill="black"/>
                <path d="M72 38.8945V38.2649C72 29.0242 76.9504 20.8676 84.5 16C92.0496 20.8676 97 29.0242 97 38.2649L97 38.2675L97 38.8261C97 45.3979 92.1701 50.264 85.9493 51V50.2897C85.9493 48.8132 87.0223 47.5993 88.3056 46.9225C91.0976 45.4501 93.0145 42.4082 93.0145 38.8945C93.0145 33.9395 89.2024 29.9227 84.5 29.9227C79.7976 29.9227 75.9855 33.9395 75.9855 38.8945C75.9855 42.4082 77.9024 45.4501 80.6944 46.9225C81.9777 47.5993 83.0507 48.8132 83.0507 50.2897V51C76.8299 50.264 72 45.4663 72 38.8945Z" fill="white"/>
                <path d="M168.279 28.4726C168.198 27.5712 167.833 26.8705 167.186 26.3707C166.547 25.8626 165.634 25.6086 164.446 25.6086C163.66 25.6086 163.005 25.711 162.481 25.9159C161.957 26.1207 161.563 26.4034 161.301 26.764C161.039 27.1164 160.904 27.522 160.896 27.9809C160.879 28.3579 160.953 28.6898 161.117 28.9766C161.289 29.2634 161.535 29.5175 161.854 29.7387C162.182 29.9518 162.575 30.1403 163.034 30.3042C163.492 30.4681 164.008 30.6115 164.582 30.7344L166.744 31.2261C167.989 31.4965 169.086 31.8571 170.036 32.3078C170.995 32.7585 171.797 33.2953 172.444 33.9181C173.1 34.5409 173.595 35.2579 173.931 36.0692C174.267 36.8805 174.439 37.7901 174.447 38.798C174.439 40.3878 174.037 41.7523 173.243 42.8913C172.448 44.0304 171.306 44.9032 169.815 45.5096C168.333 46.116 166.543 46.4192 164.446 46.4192C162.341 46.4192 160.507 46.1037 158.942 45.4727C157.378 44.8417 156.162 43.8829 155.294 42.5963C154.425 41.3097 153.979 39.6831 153.955 37.7163H159.778C159.827 38.5276 160.044 39.2037 160.429 39.7445C160.814 40.2854 161.342 40.6951 162.014 40.9738C162.694 41.2524 163.48 41.3917 164.373 41.3917C165.192 41.3917 165.888 41.2811 166.461 41.0598C167.043 40.8385 167.489 40.5312 167.8 40.1379C168.112 39.7445 168.271 39.2938 168.279 38.7858C168.271 38.3105 168.124 37.9048 167.837 37.5688C167.551 37.2246 167.108 36.9296 166.51 36.6838C165.921 36.4298 165.167 36.1962 164.25 35.9831L161.621 35.3685C159.442 34.8686 157.726 34.0615 156.473 32.947C155.22 31.8243 154.597 30.3083 154.606 28.3989C154.597 26.8419 155.015 25.4774 155.859 24.3056C156.702 23.1337 157.87 22.22 159.36 21.5644C160.851 20.9088 162.55 20.5811 164.459 20.5811C166.408 20.5811 168.099 20.9129 169.533 21.5767C170.974 22.2323 172.092 23.1542 172.887 24.3425C173.681 25.5307 174.086 26.9074 174.103 28.4726H168.279Z" fill="white"/>
                <path d="M133.462 45.8251V20.8779H150.985V25.7748H139.536V30.8909H150.089V35.7999H139.536V40.9282H150.985V45.8251H133.462Z" fill="white"/>
                <path d="M124.325 28.4726C124.243 27.5712 123.879 26.8705 123.232 26.3707C122.593 25.8626 121.679 25.6086 120.492 25.6086C119.706 25.6086 119.05 25.711 118.526 25.9159C118.002 26.1207 117.609 26.4034 117.347 26.764C117.085 27.1164 116.95 27.522 116.941 27.9809C116.925 28.3579 116.999 28.6898 117.162 28.9766C117.334 29.2634 117.58 29.5175 117.9 29.7387C118.227 29.9518 118.62 30.1403 119.079 30.3042C119.538 30.4681 120.054 30.6115 120.627 30.7344L122.789 31.2261C124.034 31.4965 125.132 31.8571 126.082 32.3078C127.04 32.7585 127.843 33.2953 128.49 33.9181C129.145 34.5409 129.641 35.2579 129.976 36.0692C130.312 36.8805 130.484 37.7901 130.492 38.798C130.484 40.3878 130.083 41.7523 129.288 42.8913C128.494 44.0304 127.351 44.9032 125.861 45.5096C124.378 46.116 122.589 46.4192 120.492 46.4192C118.387 46.4192 116.552 46.1037 114.988 45.4727C113.424 44.8417 112.207 43.8829 111.339 42.5963C110.471 41.3097 110.025 39.6831 110 37.7163H115.823C115.872 38.5276 116.09 39.2037 116.474 39.7445C116.859 40.2854 117.388 40.6951 118.059 40.9738C118.739 41.2524 119.525 41.3917 120.418 41.3917C121.237 41.3917 121.933 41.2811 122.507 41.0598C123.088 40.8385 123.535 40.5312 123.846 40.1379C124.157 39.7445 124.317 39.2938 124.325 38.7858C124.317 38.3105 124.169 37.9048 123.883 37.5688C123.596 37.2246 123.154 36.9296 122.556 36.6838C121.966 36.4298 121.213 36.1962 120.295 35.9831L117.666 35.3685C115.488 34.8686 113.772 34.0615 112.519 32.947C111.265 31.8243 110.643 30.3083 110.651 28.3989C110.643 26.8419 111.061 25.4774 111.904 24.3056C112.748 23.1337 113.915 22.22 115.406 21.5644C116.896 20.9088 118.596 20.5811 120.504 20.5811C122.453 20.5811 124.145 20.9129 125.578 21.5767C127.02 22.2323 128.138 23.1542 128.932 24.3425C129.727 25.5307 130.132 26.9074 130.148 28.4726H124.325Z" fill="white"/>
        </svg>
    </div>
        
        <!-- Main Footer Container -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Upper Footer Content -->
            <div class="flex justify-between items-start gap-4 lg:gap-10 flex-col lg:flex-row">
                <!-- Left Section -->
                <div class="flex-1 w-full lg:max-w-[400px]">
                    <div class="py-8 lg:py-12"></div>
                    <p class="text-sm leading-relaxed text-white/80 max-w-prose">
                        At SES, we bring artistry and innovation together to illuminate your spaces. With 
                        smart lighting solutions tailored to your needs, we make your life brighter, smarter, 
                        and more efficient.
                    </p>
                </div>
                
                <!-- Right Section -->
                <div class="flex-1 w-full lg:max-w-[400px]">
                    <div class="newsletter">
                        <div class="py-6 lg:py-8"></div>
                        <h3 class="text-base mb-4 text-white">Get Notified Our Newsletter</h3>
                        <p class="mb-2 text-sm">Email</p>
                        <div class="flex gap-2.5 flex-col sm:flex-row">
                            <input 
                            type="email" 
                            placeholder="Email" 
                            class="flex-1 px-4 py-2 rounded border-none bg-white text-sm focus:outline-none focus:ring-2 focus:ring-gray-200"
                            >
                            <button 
                            class="px-5 py-2 bg-white text-black rounded border-none text-sm whitespace-nowrap cursor-pointer hover:bg-gray-100 transition-colors duration-300 w-full sm:w-auto"
                            >
                            Subscribe
                        </button>
                    </div>
                        <p class="mt-2 text-sm">Enter your email address</p>
                    </div>
                </div>
            </div>

            <!-- Bottom Text -->
            <div class="mt-8 Bg-black">
                <p class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl xl:text-[100px] font-['Plus_Jakarta_Sans'] font-extrabold text-center relative transition-all duration-300">
                    Sustain Energy Solution
                </p>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const subscribeButton = document.querySelector('button');
            const emailInput = document.querySelector('input[type="email"]');

            subscribeButton.addEventListener('click', function() {
                if (emailInput.value) {
                    alert('Thank you for subscribing!');
                    emailInput.value = '';
                } else {
                    alert('Please enter your email address.');
                }
            });
        });
    </script>
</body>
</html>