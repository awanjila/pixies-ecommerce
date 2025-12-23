<template>
  <div class="min-h-screen bg-gray-50">
    <!-- Header -->
    <div class="bg-gradient-to-r from-[#084c74] to-[#0a5d8a] text-white py-16 px-4">
      <div class="max-w-4xl mx-auto">
        <h1 class="text-4xl font-bold mb-4">Shipping & Delivery Policy</h1>
        <p class="text-blue-50 text-lg">Wabegadgets - Fast, Reliable Technology Delivery</p>
      </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-4xl mx-auto px-4 py-12">
      
      <!-- Introduction -->
      <div class="bg-white rounded-lg shadow-md p-8 mb-8">
        <p class="text-gray-700 leading-relaxed">
          At Wabegadgets, we are committed to delivering your technology products safely and on time. 
          We work with trusted courier partners across Kenya to ensure your gadgets and electronics 
          reach you in perfect condition.
        </p>
      </div>

      <!-- Shipping Zones -->
      <div class="bg-white rounded-lg shadow-md p-8 mb-8">
        <div class="flex items-start mb-6">
          <div class="bg-[#084c74]/10 rounded-full p-3 mr-4">
            <svg class="w-6 h-6 text-[#084c74]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
            </svg>
          </div>
          <div class="flex-1">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">Delivery Zones & Timelines</h2>
            
            <!-- Zone Cards -->
            <div class="space-y-4">
              <div class="border-2 border-[#084c74]/20 rounded-lg p-4 hover:border-[#084c74] transition-colors">
                <div class="flex justify-between items-start mb-2">
                  <div>
                    <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                      <span>🏙️</span> Nairobi & Surroundings
                    </h3>
                    <p class="text-sm text-gray-600 mt-1">CBD, Westlands, Kilimani, Karen, Lavington, Parklands</p>
                  </div>
                  <div class="text-right">
                    <div class="text-[#084c74] font-bold">KES 300</div>
                    <div class="text-sm text-gray-600">24 Hours</div>
                  </div>
                </div>
                <div class="bg-blue-50 border-l-4 border-[#084c74] p-3 mt-3">
                  <p class="text-sm text-[#084c74] font-semibold">✓ Same-day delivery available for orders placed before 2 PM</p>
                </div>
              </div>

              <div class="border-2 border-gray-200 rounded-lg p-4 hover:border-[#084c74] transition-colors">
                <div class="flex justify-between items-start mb-2">
                  <div>
                    <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                      <span>🌆</span> Major Cities
                    </h3>
                    <p class="text-sm text-gray-600 mt-1">Mombasa, Kisumu, Nakuru, Eldoret, Thika, Machakos</p>
                  </div>
                  <div class="text-right">
                    <div class="text-[#084c74] font-bold">KES 500</div>
                    <div class="text-sm text-gray-600">2-3 Days</div>
                  </div>
                </div>
              </div>

              <div class="border-2 border-gray-200 rounded-lg p-4 hover:border-[#084c74] transition-colors">
                <div class="flex justify-between items-start mb-2">
                  <div>
                    <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                      <span>📍</span> Remote Areas
                    </h3>
                    <p class="text-sm text-gray-600 mt-1">Outlying counties and rural locations</p>
                  </div>
                  <div class="text-right">
                    <div class="text-[#084c74] font-bold">KES 1,500</div>
                    <div class="text-sm text-gray-600">3-5 Days</div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Free Shipping Banner -->
            <div class="bg-gradient-to-r from-green-50 to-blue-50 border-2 border-green-200 rounded-lg p-4 mt-6">
              <div class="flex items-center gap-3">
                <div class="text-3xl">🎁</div>
                <div>
                  <p class="font-bold text-gray-900">Free Shipping Available!</p>
                  <p class="text-sm text-gray-700">Enjoy free delivery on all orders over <span class="font-bold text-[#084c74]">KES 10,000</span> within Kenya</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Courier Partners -->
      <div class="bg-white rounded-lg shadow-md p-8 mb-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-4">Our Trusted Courier Partners</h2>
        <div class="grid md:grid-cols-3 gap-4">
          <div class="border border-gray-200 rounded-lg p-4 text-center hover:border-[#084c74] transition-colors">
            <div class="text-4xl mb-2">🚚</div>
            <h3 class="font-bold text-gray-900">G4S Courier</h3>
            <p class="text-sm text-gray-600 mt-1">Express & Standard</p>
          </div>
          <div class="border border-gray-200 rounded-lg p-4 text-center hover:border-[#084c74] transition-colors">
            <div class="text-4xl mb-2">📦</div>
            <h3 class="font-bold text-gray-900">Fargo Courier</h3>
            <p class="text-sm text-gray-600 mt-1">Economy Shipping</p>
          </div>
          <div class="border border-gray-200 rounded-lg p-4 text-center hover:border-[#084c74] transition-colors">
            <div class="text-4xl mb-2">✈️</div>
            <h3 class="font-bold text-gray-900">DHL Kenya</h3>
            <p class="text-sm text-gray-600 mt-1">Premium Express</p>
          </div>
        </div>
      </div>

      <!-- How Shipping Works -->
      <div class="bg-white rounded-lg shadow-md p-8 mb-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">How Our Shipping Works</h2>
        <div class="space-y-4">
          <div class="flex items-start">
            <div class="bg-[#084c74] text-white rounded-full w-8 h-8 flex items-center justify-center font-bold mr-4 flex-shrink-0">1</div>
            <div>
              <h3 class="font-semibold text-gray-900 mb-1">Order Processing</h3>
              <p class="text-gray-700">Orders are processed within 24 hours on business days. You'll receive an order confirmation email immediately after purchase.</p>
            </div>
          </div>
          <div class="flex items-start">
            <div class="bg-[#084c74] text-white rounded-full w-8 h-8 flex items-center justify-center font-bold mr-4 flex-shrink-0">2</div>
            <div>
              <h3 class="font-semibold text-gray-900 mb-1">Quality Check & Packaging</h3>
              <p class="text-gray-700">Every item is inspected for quality and carefully packaged with protective materials to ensure safe transit.</p>
            </div>
          </div>
          <div class="flex items-start">
            <div class="bg-[#084c74] text-white rounded-full w-8 h-8 flex items-center justify-center font-bold mr-4 flex-shrink-0">3</div>
            <div>
              <h3 class="font-semibold text-gray-900 mb-1">Dispatch & Tracking</h3>
              <p class="text-gray-700">Once shipped, you'll receive a tracking number via SMS and email to monitor your delivery in real-time.</p>
            </div>
          </div>
          <div class="flex items-start">
            <div class="bg-[#084c74] text-white rounded-full w-8 h-8 flex items-center justify-center font-bold mr-4 flex-shrink-0">4</div>
            <div>
              <h3 class="font-semibold text-gray-900 mb-1">Delivery & Confirmation</h3>
              <p class="text-gray-700">Our courier will contact you before delivery. Please inspect your package immediately upon receipt.</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Special Handling -->
      <div class="bg-white rounded-lg shadow-md p-8 mb-8">
        <div class="flex items-start mb-4">
          <div class="bg-[#084c74]/10 rounded-full p-3 mr-4">
            <svg class="w-6 h-6 text-[#084c74]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
          </div>
          <div class="flex-1">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">Special Handling for Electronics</h2>
            <ul class="space-y-3">
              <li class="flex items-start">
                <span class="text-[#084c74] mr-2 mt-1">•</span>
                <div>
                  <span class="font-semibold text-gray-900">Fragile Items:</span>
                  <span class="text-gray-700"> All electronics are packaged with bubble wrap and cushioning materials</span>
                </div>
              </li>
              <li class="flex items-start">
                <span class="text-[#084c74] mr-2 mt-1">•</span>
                <div>
                  <span class="font-semibold text-gray-900">Large Items:</span>
                  <span class="text-gray-700"> TVs, monitors, and large appliances may require additional handling time and fees</span>
                </div>
              </li>
              <li class="flex items-start">
                <span class="text-[#084c74] mr-2 mt-1">•</span>
                <div>
                  <span class="font-semibold text-gray-900">High-Value Items:</span>
                  <span class="text-gray-700"> Orders over KES 50,000 may require signature confirmation</span>
                </div>
              </li>
              <li class="flex items-start">
                <span class="text-[#084c74] mr-2 mt-1">•</span>
                <div>
                  <span class="font-semibold text-gray-900">Installation Services:</span>
                  <span class="text-gray-700"> Available for TVs, CCTV systems, and networking equipment (additional charges apply)</span>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>

      <!-- Order Tracking -->
      <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border-2 border-[#084c74]/30 rounded-lg p-8 mb-8">
        <div class="flex items-start gap-4">
          <div class="text-4xl">📱</div>
          <div class="flex-1">
            <h2 class="text-2xl font-bold text-gray-900 mb-3">Track Your Order</h2>
            <p class="text-gray-700 mb-4">
              Stay updated on your delivery status with real-time tracking:
            </p>
            <ul class="space-y-2 text-gray-700">
              <li>✓ SMS notifications at each delivery milestone</li>
              <li>✓ Email updates with tracking links</li>
              <li>✓ Live tracking through courier website</li>
              <li>✓ Direct contact with delivery personnel</li>
            </ul>
          </div>
        </div>
      </div>

      <!-- Delivery Issues -->
      <div class="bg-white rounded-lg shadow-md p-8 mb-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-4">Delivery Issues & Solutions</h2>
        <div class="space-y-4">
          <div class="border-l-4 border-yellow-400 bg-yellow-50 p-4">
            <h3 class="font-bold text-gray-900 mb-1">📦 Package Not Received</h3>
            <p class="text-gray-700 text-sm">Contact us immediately at <a href="tel:+254710909198" class="text-[#084c74] font-semibold hover:underline">+254 710 909 198</a>. We'll work with the courier to locate your package.</p>
          </div>
          <div class="border-l-4 border-red-400 bg-red-50 p-4">
            <h3 class="font-bold text-gray-900 mb-1">📋 Damaged on Arrival</h3>
            <p class="text-gray-700 text-sm">Inspect your package before accepting. If damaged, take photos and refuse delivery or note the damage with the courier. Contact us within 48 hours for replacement.</p>
          </div>
          <div class="border-l-4 border-blue-400 bg-blue-50 p-4">
            <h3 class="font-bold text-gray-900 mb-1">❌ Wrong Item Delivered</h3>
            <p class="text-gray-700 text-sm">Don't open the package. Contact us immediately for a return authorization and we'll arrange pickup and correct delivery at no extra cost.</p>
          </div>
          <div class="border-l-4 border-green-400 bg-green-50 p-4">
            <h3 class="font-bold text-gray-900 mb-1">⏰ Delivery Delays</h3>
            <p class="text-gray-700 text-sm">Check your tracking number for updates. If delivery exceeds the estimated timeframe, contact us and we'll investigate with the courier.</p>
          </div>
        </div>
      </div>

      <!-- FAQ Section -->
      <div class="bg-white rounded-lg shadow-md p-8 mb-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Frequently Asked Questions</h2>
        <div class="space-y-3">
          <div class="border border-gray-200 rounded-lg overflow-hidden">
            <button 
              @click="expandedFAQ = expandedFAQ === 0 ? null : 0"
              class="w-full flex justify-between items-center p-4 text-left hover:bg-gray-50 transition-colors"
            >
              <span class="font-semibold text-gray-900">How are shipping costs calculated?</span>
              <span class="text-[#084c74] text-xl">{{ expandedFAQ === 0 ? '−' : '+' }}</span>
            </button>
            <div v-show="expandedFAQ === 0" class="px-4 pb-4 text-gray-700 border-t border-gray-100">
              <p class="pt-3">Shipping costs are based on your delivery location and package weight. Nairobi deliveries start at KES 300, major cities at KES 500, and remote areas at KES 1,500. You'll see the exact shipping cost at checkout before completing your purchase.</p>
            </div>
          </div>

          <div class="border border-gray-200 rounded-lg overflow-hidden">
            <button 
              @click="expandedFAQ = expandedFAQ === 1 ? null : 1"
              class="w-full flex justify-between items-center p-4 text-left hover:bg-gray-50 transition-colors"
            >
              <span class="font-semibold text-gray-900">Do you offer free shipping?</span>
              <span class="text-[#084c74] text-xl">{{ expandedFAQ === 1 ? '−' : '+' }}</span>
            </button>
            <div v-show="expandedFAQ === 1" class="px-4 pb-4 text-gray-700 border-t border-gray-100">
              <p class="pt-3">Yes! We offer free shipping on all orders over KES 10,000 within Kenya. This applies to all delivery zones including Nairobi, major cities, and remote areas.</p>
            </div>
          </div>

          <div class="border border-gray-200 rounded-lg overflow-hidden">
            <button 
              @click="expandedFAQ = expandedFAQ === 2 ? null : 2"
              class="w-full flex justify-between items-center p-4 text-left hover:bg-gray-50 transition-colors"
            >
              <span class="font-semibold text-gray-900">Can I change my delivery address after ordering?</span>
              <span class="text-[#084c74] text-xl">{{ expandedFAQ === 2 ? '−' : '+' }}</span>
            </button>
            <div v-show="expandedFAQ === 2" class="px-4 pb-4 text-gray-700 border-t border-gray-100">
              <p class="pt-3">Address changes are possible before dispatch. Contact us immediately at +254 710 909 198. Once the package is dispatched, address changes may incur additional fees or require package redirection through the courier.</p>
            </div>
          </div>

          <div class="border border-gray-200 rounded-lg overflow-hidden">
            <button 
              @click="expandedFAQ = expandedFAQ === 3 ? null : 3"
              class="w-full flex justify-between items-center p-4 text-left hover:bg-gray-50 transition-colors"
            >
              <span class="font-semibold text-gray-900">Do you ship on weekends?</span>
              <span class="text-[#084c74] text-xl">{{ expandedFAQ === 3 ? '−' : '+' }}</span>
            </button>
            <div v-show="expandedFAQ === 3" class="px-4 pb-4 text-gray-700 border-t border-gray-100">
              <p class="pt-3">Orders placed on weekends are processed on the next business day (Monday). However, we offer Saturday deliveries in Nairobi for orders placed before Friday 2 PM. Sunday deliveries are not available.</p>
            </div>
          </div>

          <div class="border border-gray-200 rounded-lg overflow-hidden">
            <button 
              @click="expandedFAQ = expandedFAQ === 4 ? null : 4"
              class="w-full flex justify-between items-center p-4 text-left hover:bg-gray-50 transition-colors"
            >
              <span class="font-semibold text-gray-900">What if I'm not available to receive my delivery?</span>
              <span class="text-[#084c74] text-xl">{{ expandedFAQ === 4 ? '−' : '+' }}</span>
            </button>
            <div v-show="expandedFAQ === 4" class="px-4 pb-4 text-gray-700 border-t border-gray-100">
              <p class="pt-3">The courier will contact you before delivery to arrange a convenient time. If you're unavailable, you can authorize someone else to receive the package on your behalf. Alternative delivery dates can also be arranged through the courier.</p>
            </div>
          </div>

          <div class="border border-gray-200 rounded-lg overflow-hidden">
            <button 
              @click="expandedFAQ = expandedFAQ === 5 ? null : 5"
              class="w-full flex justify-between items-center p-4 text-left hover:bg-gray-50 transition-colors"
            >
              <span class="font-semibold text-gray-900">Are all items insured during shipping?</span>
              <span class="text-[#084c74] text-xl">{{ expandedFAQ === 5 ? '−' : '+' }}</span>
            </button>
            <div v-show="expandedFAQ === 5" class="px-4 pb-4 text-gray-700 border-t border-gray-100">
              <p class="pt-3">Yes, all shipments are insured for their full value. In the rare event of damage or loss during transit, we'll process a replacement or full refund at no cost to you. Always inspect packages before accepting delivery.</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Contact Section -->
      <div class="bg-gradient-to-r from-[#084c74] to-[#0a5d8a] text-white rounded-lg p-8">
        <h2 class="text-2xl font-bold mb-4">Questions About Shipping?</h2>
        <p class="mb-6">Our customer service team is ready to assist you with any delivery inquiries.</p>
        <div class="space-y-3">
          <div class="flex items-center">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
            </svg>
            <a href="tel:+254710909198" class="hover:text-blue-200">+254 710 909 198</a>
          </div>
          <div class="flex items-center">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
            </svg>
            <span>wabegadgets.co.ke</span>
          </div>
        </div>
        <p class="mt-6 text-sm text-blue-100">
          Business Hours: Monday - Friday, 8:00 AM - 6:00 PM | Saturday, 9:00 AM - 3:00 PM
        </p>
      </div>

      <!-- Footer Note -->
      <div class="mt-8 text-center text-gray-600 text-sm">
        <p>Last Updated: December 2025</p>
        <p class="mt-2">Wabegadgets reserves the right to update this policy. Changes will be communicated on our website.</p>
      </div>

    </div>
  </div>
</template>

<script>
export default {
  name: 'ShippingPolicy',
  data() {
    return {
      expandedFAQ: null
    };
  }
};
</script>