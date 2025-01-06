<!-- Testimonial Hero Section -->
<div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8 py-24">
  <div class="relative rounded-2xl overflow-hidden h-auto lg:h-[665px]">
    <!-- Background Image -->
    <div
      class="absolute inset-0 bg-cover bg-center bg-no-repeat rounded-3xl"
      style="background-image: url('assets/image/Futuristic Mesh-Lit Lounge 1.png');"
    >
      <div class="absolute inset-0 bg-black/20"></div>
    </div>

    <!-- Content -->
    <div class="relative z-10 flex h-full flex-col justify-between px-8 py-16">
      <!-- Hero Text -->
      <div class="max-w-xl">
        <h1 class="text-3xl font-medium tracking-tight text-white sm:text-4xl md:text-5xl lg:text-6xl">
          A better future starts
          <br />
          from your workspace
        </h1>
      </div>

      <!-- Testimonial Card -->
      <div class="flex justify-end mt-8">
        <div class="max-w-xl w-full lg:w-2/3">
          <div class="bg-white/95 backdrop-blur rounded-lg shadow-lg">
            <div class="p-6">
              <h2 class="mb-4 text-xl font-medium text-gray-900">
                Who have gotten their light with us
              </h2>
              <div id="testimonialContent">
                <p class="mb-6 text-gray-600" id="testimonialText">
                  I love how effortlessly I can control my lights from my phone. It's not just efficient but also adds a touch of modern elegance to my space.
                </p>
                <div class="flex items-center justify-between">
                  <p class="text-sm font-medium text-gray-800" id="testimonialAuthor">
                    Sarah Johnson
                  </p>
                  <div class="flex gap-2">
                    <button
                      onclick="previousTestimonial()"
                      class="h-8 w-8 inline-flex items-center justify-center rounded-md border border-gray-200 hover:bg-gray-100"
                      aria-label="Previous Testimonial"
                    >
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="m15 18-6-6 6-6"/>
                      </svg>
                    </button>
                    <button
                      onclick="nextTestimonial()"
                      class="h-8 w-8 inline-flex items-center justify-center rounded-md border border-gray-200 hover:bg-gray-100"
                      aria-label="Next Testimonial"
                    >
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="m9 18 6-6-6-6"/>
                      </svg>
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  // Hardcoded testimonial data
  const testimonials = [
    {
      content: "I love how effortlessly I can control my lights from my phone. It's not just efficient but also adds a touch of modern elegance to my space.",
      author: "Sarah Johnson"
    },
    {
      content: "The lighting system is incredible! It transformed my workspace into a productive and comfortable environment.",
      author: "John Doe"
    },
    {
      content: "Great experience! The installation was quick, and now my house looks amazing with these smart lights.",
      author: "Emily Carter"
    }
  ];

  let currentIndex = 0;

  // Function to show the previous testimonial
  function previousTestimonial() {
    currentIndex = (currentIndex - 1 + testimonials.length) % testimonials.length;
    updateTestimonial();
  }

  // Function to show the next testimonial
  function nextTestimonial() {
    currentIndex = (currentIndex + 1) % testimonials.length;
    updateTestimonial();
  }

  // Function to update the testimonial content
  function updateTestimonial() {
    document.getElementById('testimonialText').innerText = testimonials[currentIndex].content;
    document.getElementById('testimonialAuthor').innerText = testimonials[currentIndex].author;
  }
</script>
