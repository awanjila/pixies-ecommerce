<template>
  <div class="min-h-screen bg-gray-50">
    <!-- Header -->
    <div class="bg-gradient-to-r from-[#084c74] to-[#0a5d8a] text-white py-16 px-4">
      <div class="max-w-6xl mx-auto">
        <h1 class="text-4xl font-bold mb-4">About Wabegadgets</h1>
        <p class="text-blue-50 text-lg">Your trusted partner in smart electronics and security solutions</p>
      </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-6xl mx-auto px-4 py-12">
      
      <!-- Company Overview -->
      <div class="bg-white rounded-lg shadow-md p-8 mb-8">
        <h2 class="text-3xl font-bold text-gray-900 mb-6">Who We Are</h2>
        <div class="space-y-4 text-gray-700 leading-relaxed">
          <p class="text-lg">
            <strong class="text-[#084c74]">Wabegadgets</strong> is a registered electronics and smart devices retailer 
            based in Nairobi, Kenya. We specialize in providing high-quality electronics, smart home devices, 
            security systems, biometric solutions, and cutting-edge technology products to homes and businesses across Kenya.
          </p>
          <p>
            Our business is built on a simple principle: customers deserve reliable access to quality 
            electronics without compromise. We source, stock, and distribute authentic technology products that 
            meet international standards and serve the practical needs of Kenya's growing tech market.
          </p>
        </div>
      </div>

      <!-- Key Information Grid -->
      <div class="grid md:grid-cols-2 gap-6 mb-8">
        <!-- Business Details -->
        <div class="bg-white rounded-lg shadow-md p-6">
          <div class="flex items-start mb-4">
            <div class="bg-[#084c74] text-white rounded-lg p-3 mr-4">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
              </svg>
            </div>
            <div>
              <h3 class="text-xl font-semibold text-gray-900 mb-2">Business Information</h3>
              <ul class="space-y-2 text-gray-700">
                <li><strong>Trading Name:</strong> Wabegadgets</li>
                <li><strong>Registration:</strong> Registered business in Kenya</li>
                <li><strong>Status:</strong> Active and operational</li>
              </ul>
            </div>
          </div>
        </div>

        <!-- Location -->
        <div class="bg-white rounded-lg shadow-md p-6">
          <div class="flex items-start mb-4">
            <div class="bg-[#084c74] text-white rounded-lg p-3 mr-4">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
              </svg>
            </div>
            <div>
              <h3 class="text-xl font-semibold text-gray-900 mb-2">Our Location</h3>
              <ul class="space-y-2 text-gray-700">
                <li><strong>Address:</strong> Parklands 3rd Ave</li>
                <li><strong>Location:</strong>  Nairobi</li>
                <li><strong>Country:</strong> Kenya</li>
                <li><strong>Service Area:</strong> Countrywide delivery</li>
              </ul>
            </div>
          </div>
        </div>
      </div>

      <!-- What We Sell -->
      <div class="bg-white rounded-lg shadow-md p-8 mb-8">
        <h2 class="text-3xl font-bold text-gray-900 mb-6">What We Offer</h2>
        <p class="text-gray-700 mb-6">
          We stock and distribute a comprehensive range of electronics and smart technology products:
        </p>

        <div class="grid md:grid-cols-3 gap-6">
          <!-- Smart Devices & Electronics -->
          <div class="border-2 border-[#084c74]/30 rounded-lg p-6">
            <div class="bg-[#084c74]/10 rounded-full w-12 h-12 flex items-center justify-center mb-4">
              <svg class="w-6 h-6 text-[#084c74]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
              </svg>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-3">Smart Devices & Electronics</h3>
            <ul class="space-y-2 text-gray-700 text-sm">
              <li>• Smartphones & Tablets</li>
              <li>• Laptops & Computers</li>
              <li>• Smart TVs & Displays</li>
              <li>• Audio Systems & Speakers</li>
              <li>• Smartwatches & Wearables</li>
              <li>• Gaming Consoles & Accessories</li>
              <li>• Cameras & Photography Equipment</li>
            </ul>
          </div>

          <!-- Security Systems -->
          <div class="border-2 border-[#084c74]/30 rounded-lg p-6">
            <div class="bg-[#084c74]/10 rounded-full w-12 h-12 flex items-center justify-center mb-4">
              <svg class="w-6 h-6 text-[#084c74]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
              </svg>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-3">Security Systems</h3>
            <ul class="space-y-2 text-gray-700 text-sm">
              <li>• CCTV Cameras & Surveillance</li>
              <li>• IP Cameras & NVR Systems</li>
              <li>• Access Control Systems</li>
              <li>• Alarm Systems</li>
              <li>• Video Doorbells</li>
              <li>• Motion Detectors</li>
              <li>• Security Monitoring Solutions</li>
            </ul>
          </div>

          <!-- Biometrics & Smart Home -->
          <div class="border-2 border-[#084c74]/30 rounded-lg p-6">
            <div class="bg-[#084c74]/10 rounded-full w-12 h-12 flex items-center justify-center mb-4">
              <svg class="w-6 h-6 text-[#084c74]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.07 2.019-.203 3m-2.118 6.844A21.88 21.88 0 0015.171 17m3.839 1.132c.645-2.266.99-4.659.99-7.132A8 8 0 008 4.07M3 15.364c.64-1.319 1-2.8 1-4.364 0-1.457.39-2.823 1.07-4" />
              </svg>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-3">Biometrics & Smart Home</h3>
            <ul class="space-y-2 text-gray-700 text-sm">
              <li>• Biometric Door Locks</li>
              <li>• Fingerprint Scanners</li>
              <li>• Face Recognition Systems</li>
              <li>• Smart Home Automation</li>
              <li>• Smart Lighting Systems</li>
              <li>• Smart Thermostats</li>
              <li>• Voice Assistants & Hubs</li>
              <li>• Smart Plugs & Switches</li>
            </ul>
          </div>
        </div>
      </div>

      <!-- Who We Serve -->
      <div class="bg-white rounded-lg shadow-md p-8 mb-8">
        <h2 class="text-3xl font-bold text-gray-900 mb-6">Who We Serve</h2>
        <p class="text-gray-700 mb-6">
          Our clients include individuals, businesses, and institutions across Kenya:
        </p>

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
          <div class="text-center p-6 bg-[#084c74]/5 rounded-lg">
            <div class="bg-[#084c74] text-white rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
              <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
              </svg>
            </div>
            <h3 class="text-lg font-semibold text-gray-900 mb-2">Homeowners</h3>
            <p class="text-gray-600 text-sm">Smart home solutions and personal electronics</p>
          </div>

          <div class="text-center p-6 bg-[#084c74]/5 rounded-lg">
            <div class="bg-[#084c74] text-white rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
              <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
              </svg>
            </div>
            <h3 class="text-lg font-semibold text-gray-900 mb-2">Businesses</h3>
            <p class="text-gray-600 text-sm">Security systems and office technology</p>
          </div>

          <div class="text-center p-6 bg-[#084c74]/5 rounded-lg">
            <div class="bg-[#084c74] text-white rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
              <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
              </svg>
            </div>
            <h3 class="text-lg font-semibold text-gray-900 mb-2">Educational Institutions</h3>
            <p class="text-gray-600 text-sm">Technology infrastructure and security</p>
          </div>

          <div class="text-center p-6 bg-[#084c74]/5 rounded-lg">
            <div class="bg-[#084c74] text-white rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
              <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
              </svg>
            </div>
            <h3 class="text-lg font-semibold text-gray-900 mb-2">Retailers & Resellers</h3>
            <p class="text-gray-600 text-sm">Wholesale electronics supply</p>
          </div>
        </div>
      </div>

      <!-- Why Choose Us -->
      <div class="bg-gradient-to-r from-gray-900 to-black text-white rounded-lg p-8 mb-8">
        <h2 class="text-3xl font-bold mb-6">Why Work With Us</h2>
        <div class="grid md:grid-cols-2 gap-6">
          <div class="flex items-start">
            <div class="bg-[#084c74] rounded-full p-2 mr-4 mt-1">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
              </svg>
            </div>
            <div>
              <h3 class="font-semibold text-lg mb-2">Authentic Products</h3>
              <p class="text-gray-300">We source directly from authorized distributors and manufacturers. All products are genuine and come with valid warranties.</p>
            </div>
          </div>

          <div class="flex items-start">
            <div class="bg-[#084c74] rounded-full p-2 mr-4 mt-1">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
              </svg>
            </div>
            <div>
              <h3 class="font-semibold text-lg mb-2">Latest Technology</h3>
              <p class="text-gray-300">We stay updated with the latest tech trends and innovations, bringing you cutting-edge devices and smart solutions.</p>
            </div>
          </div>

          <div class="flex items-start">
            <div class="bg-[#084c74] rounded-full p-2 mr-4 mt-1">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
              </svg>
            </div>
            <div>
              <h3 class="font-semibold text-lg mb-2">Expert Installation</h3>
              <p class="text-gray-300">Professional installation services for security systems, biometric devices, and smart home solutions across Kenya.</p>
            </div>
          </div>

          <div class="flex items-start">
            <div class="bg-[#084c74] rounded-full p-2 mr-4 mt-1">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
              </svg>
            </div>
            <div>
              <h3 class="font-semibold text-lg mb-2">Reliable Support</h3>
              <p class="text-gray-300">Our technical team provides ongoing support, maintenance, and troubleshooting for all products we supply.</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Regulatory Compliance -->
      <div class="bg-white rounded-lg shadow-md p-8 mb-8">
        <h2 class="text-3xl font-bold text-gray-900 mb-6">Regulatory Compliance</h2>
        <p class="text-gray-700 mb-4">
          As an electronics retailer operating in Kenya, we comply with:
        </p>
        <ul class="space-y-3 text-gray-700">
          <li class="flex items-start">
            <span class="text-[#084c74] font-bold mr-2">•</span>
            <span><strong>Communications Authority of Kenya (CA)</strong> regulations for electronic devices</span>
          </li>
          <li class="flex items-start">
            <span class="text-[#084c74] font-bold mr-2">•</span>
            <span><strong>Kenya Bureau of Standards (KEBS)</strong> quality and safety standards</span>
          </li>
          <li class="flex items-start">
            <span class="text-[#084c74] font-bold mr-2">•</span>
            <span><strong>Kenya Revenue Authority (KRA)</strong> tax requirements and proper business documentation</span>
          </li>
          <li class="flex items-start">
            <span class="text-[#084c74] font-bold mr-2">•</span>
            <span><strong>Data Protection Act, 2019</strong> for customer information security</span>
          </li>
        </ul>
      </div>

      <!-- Contact Section -->
      <div class="bg-gradient-to-r from-[#084c74] to-[#0a5d8a] text-white rounded-lg p-8">
        <h2 class="text-3xl font-bold mb-4">Get In Touch</h2>
        <p class="text-blue-50 mb-6 text-lg">
          Ready to order or have questions about our products? Contact us today.
        </p>

        <div class="grid md:grid-cols-2 gap-6">
          <div>
            <h3 class="font-semibold text-xl mb-4">Contact Information</h3>
            <div class="space-y-3">
              <div class="flex items-center">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                </svg>
                <div>
                  <p class="text-sm text-blue-100">Phone</p>
                  <a href="tel:+254710909198" class="text-lg font-semibold hover:text-blue-200">+254 710 909 198</a>
                </div>
              </div>

              <div class="flex items-center">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                </svg>
                <div>
                  <p class="text-sm text-blue-100">Website</p>
                  <span class="text-lg font-semibold">wabegadgets.co.ke</span>
                </div>
              </div>
            </div>
          </div>

          <div>
            <h3 class="font-semibold text-xl mb-4">Visit Our Store</h3>
            <div class="flex items-start">
              <svg class="w-6 h-6 mr-3 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
              </svg>
              <div>
                <p class="font-semibold">Coming soon</p>
                <p class="text-blue-100">Thika Road</p>
                <p class="text-blue-100">Nairobi, Kenya</p>
              </div>
            </div>
            <div class="mt-4 text-sm text-blue-100">
              <p><strong>Business Hours:</strong></p>
              <p>Monday - Friday: 8:00 AM - 6:00 PM</p>
              <p>Saturday: 9:00 AM - 3:00 PM</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Footer Note -->
      <div class="mt-8 text-center text-gray-600 text-sm bg-white rounded-lg p-6">
        <p class="font-semibold mb-2">Wabegadgets</p>
        <p>Registered electronics retailer in Kenya</p>
        <p class="mt-4 text-xs text-gray-500">
          © 2025 Wabegadgets. All rights reserved.
        </p>
      </div>

    </div>
  </div>
</template>

<script>
export default {
  name: 'AboutUs',
  mounted() {
    window.scrollTo(0, 0);
  }
}
</script>