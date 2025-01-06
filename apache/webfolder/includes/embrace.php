<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Features Section with Animation</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes fade-in-up {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .js-fade-in {
            opacity: 0; /* Awalnya transparan */
            transform: translateY(20px); /* Mulai dengan posisi sedikit ke bawah */
            transition: opacity 0.5s ease, transform 0.5s ease; /* Tambahkan transisi */
        }

        .js-fade-in.is-visible {
            opacity: 1; /* Muncul sepenuhnya */
            transform: translateY(0); /* Kembali ke posisi normal */
        }
    </style>
</head>
<body class="bg-gray-100">

<!-- Features Section -->
<div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8 py-24">
    <div class="flex flex-col lg:flex-row justify-start items-start lg:items-end gap-12 lg:gap-24">
        <!-- Left Section -->
        <div class="flex flex-col justify-start items-start gap-5 max-w-xs js-fade-in">
            <div class="flex flex-col justify-start items-start max-w-xs">
                <h1 class="text-black text-[38px] font-light leading-normal tracking-tight">
                    Embrace Future Light To Your Workspace
                </h1>
                <p class="text-gray-400 text-[38px] font-light leading-normal tracking-tight">
                    With Four Simple Steps
                </p>
            </div>
            <img 
                src="assets/image/Hand-held Beacon of Inspiration Against Sunset 1.png"
                alt="Hand-held light bulb against sunset" 
                class="rounded-lg w-full max-w-xs h-auto transition-transform duration-500 hover:scale-105 js-fade-in"
            />
        </div>

        <!-- Right Section -->
        <div class="flex-1">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-full">
                <?php
                $steps = [
                    [
                        "title" => "Book a Consultation",
                        "description" => "Take the first step by booking a consultation with our team. This helps us schedule a convenient time to evaluate your lighting needs.",
                    ],
                    [
                        "title" => "Site Survey",
                        "description" => "Our experts will visit your location to understand your requirements, assess the space, and gather all necessary details to recommend the ideal lighting solutions.",
                    ],
                    [
                        "title" => "Sign Off",
                        "description" => "Review the proposed plan and confirm the details. Once everything is approved, we'll move forward to bring your lighting vision to life.",
                    ],
                    [
                        "title" => "Get Your Light",
                        "description" => "Enjoy a seamless experience as we deliver and install your chosen lighting solutions, transforming your space effortlessly.",
                    ]
                ];

                foreach ($steps as $index => $step) {
                    $stepNumber = $index + 1;
                    echo "
                    <div class='bg-white rounded-lg shadow-md p-12 flex flex-col gap-8 h-full transition-transform transform hover:-translate-y-2 hover:shadow-lg duration-300 js-fade-in'>
                        <div class='flex items-center gap-4'>
                            <div class='bg-black text-white text-center rounded-full w-12 h-12 flex items-center justify-center'>
                                <p class='text-[32px] font-normal tracking-tight'>{$stepNumber}</p>
                            </div>
                            <h2 class='text-black text-xl font-normal'>{$step['title']}</h2>
                        </div>
                        <p class='text-black text-base font-normal leading-relaxed flex-grow'>
                            {$step['description']}
                        </p>
                    </div>";
                }
                ?>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript for Animation -->
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const observerOptions = {
            root: null, // viewport default
            threshold: 0.2, // elemen terlihat minimal 20%
        };

        const observerCallback = (entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add("is-visible");
                    observer.unobserve(entry.target); // Hentikan observasi setelah animasi selesai
                }
            });
        };

        const observer = new IntersectionObserver(observerCallback, observerOptions);

        // Pilih semua elemen dengan class js-fade-in
        const elements = document.querySelectorAll(".js-fade-in");
        elements.forEach(el => observer.observe(el));
    });
</script>

</body>
</html>
