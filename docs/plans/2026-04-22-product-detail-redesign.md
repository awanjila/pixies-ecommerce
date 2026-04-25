# Product Detail Page Redesign Implementation Plan

> **For Claude:** REQUIRED SUB-SKILL: Use superpowers:executing-plans to implement this plan task-by-task.

**Goal:** Restyle ProductDetail.vue to match CCTV store clean aesthetic with WhatsApp "Buy with Shop" button.

**Architecture:** Simplify the layout - remove gradients, use clean bordered grid, replace checkout button with WhatsApp link.

**Tech Stack:** Vue.js, CSS

---

### Task 1: Update Template - Add WhatsApp Button

**Files:**
- Modify: `D:\Laravel Projects\PIXIES\resources\js\components\ProductDetail.vue:115-122`

**Step 1: Replace product-actions section with WhatsApp button**

Replace lines 115-122:
```vue
<div class="product-actions">
  <a 
    :href="whatsappLink" 
    class="whatsapp-btn"
    target="_blank"
    rel="noopener noreferrer"
  >
    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
      <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.964-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.174.198-.298.298-.397.099-.1.198-.173.347-.083.297.15.746.585.886 1.07l.015.03c.198 1.136.916 1.843 1.446 1.891.33.03.609-.06.784-.178.173-.148.298-.347.397-.521.149-.149.173-.298.074-.397-.074-.074-.672-.636-.917-.861-.245-.224-.52-.247-.74-.124-.218.124-.462.347-.581.486-.119.139-.198.198-.298.298-.099.1-.149.173-.223.297z"/>
      <path d="M20.885 2.836c-1.265-.632-2.645-.953-4.071-.997-1.356-.044-2.611.131-3.758.573-1.105.427-2.064 1.143-2.878 2.02-.813.878-1.445 1.936-1.794 3.107-.349 1.171-.435 2.318-.303 3.473.131 1.155.533 2.258 1.164 3.229l.007.011c.569.888 1.531 1.548 2.473 1.892.943.343 1.875.461 2.787.461.912 0 1.823-.118 2.671-.461.848-.343 1.647-.906 2.279-1.609.632-.703 1.108-1.563 1.359-2.477l.021-.074c.146-.493.11-1.041-.002-1.517l.006-.021c-.21-.916-.855-1.775-1.765-2.354-.91-.579-2.023-.906-3.226-.906h-.003c-.462.005-1.023.067-1.503.201-.48.135-.908.404-1.259.807-.352.403-.563.941-.563 1.52v.038c0 .616.217 1.213.627 1.694.41.48.962.783 1.535.783.254 0 .508-.051.752-.152.244-.101.463-.263.646-.463.183-.2.342-.432.473-.69.132-.259.19-.525.19-.795v-.035c.005-.562-.197-1.123-.587-1.596-.39-.472-.965-.747-1.578-.747-.264 0-.52.053-.758.158-.239.105-.442.283-.599.526-.158.243-.253.548-.253.903v.017c0 .403.105.797.313 1.166.208.37.544.673.966.869l.01.005c.136.06.287.106.443.133.155.027.315.041.479.041h.035c.164 0 .332-.014.498-.046.166-.032.335-.083.504-.163.17-.08.332-.18.482-.304.15-.124.28-.27.398-.435.118-.165.212-.348.28-.549l.026-.063c.304-.875.234-1.876-.206-2.737-.44-.861-1.161-1.588-2.006-2.024-.846-.436-1.801-.656-2.779-.64-1.137.018-2.204.438-3.06 1.197l-.02.017c-.21.187-.425.381-.639.581.214-.017.429-.026.649-.026.978-.005 1.923.171 2.752.513.829.342 1.532.859 2.062 1.51.53.652.892 1.466 1.022 2.359.065.447.088.891.07 1.327l-.008.166c2.452-.109 4.515-1.015 6.094-2.533 1.58-1.518 2.583-3.585 2.771-5.792l.006.073c.012-.152.018-.305.018-.461 0-.918-.162-1.776-.462-2.536-.3-.76-.739-1.451-1.274-2.024z"/>
    </svg>
    Buy with Shop
  </a>
</div>
```

**Step 2: Commit**

```bash
git add resources/js/components/ProductDetail.vue
git commit -m "feat: add WhatsApp button to product detail"
```

---

### Task 2: Add WhatsApp Link Method

**Files:**
- Modify: `D:\Laravel Projects\PIXIES\resources\js\components\ProductDetail.vue:367-392`

**Step 1: Add computed property for WhatsApp link**

In computed section, add:
```javascript
computed: {
  // ... existing computed
  whatsappLink() {
    const phone = '+254798742543';
    const message = `Hi, I'm interested in ${this.product.product_name} - KES ${this.formatPrice(this.product.selling_price)}`;
    return `https://wa.me/${phone.replace(/\+/g, '')}?text=${encodeURIComponent(message)}`;
  }
}
```

**Step 2: Commit**

```bash
git add resources/js/components/ProductDetail.vue
git commit -m "feat: add WhatsApp link computed property"
```

---

### Task 3: Simplify Styles - Remove Complex Elements

**Files:**
- Modify: `D:\Laravel Projects\PIXIES\resources\js\components\ProductDetail.vue:457-1423`

**Step 1: Clean up product-images section styles**

```css
.product-images {
  background: #ffffff;
  padding: 24px;
  border: 1px solid #e5e5e5;
}

.main-image {
  background: #f5f5f5;
  border-radius: 8px;
  margin-bottom: 16px;
}
```

**Step 2: Clean up product-info section styles**

```css
.product-info {
  background: #ffffff;
  padding: 24px;
  border: 1px solid #e5e5e5;
}
```

**Step 3: Style WhatsApp button**

```css
.whatsapp-btn {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 10px;
  width: 100%;
  padding: 14px 24px;
  background: #25d366;
  color: #ffffff;
  border: none;
  border-radius: 6px;
  font-size: 1rem;
  font-weight: 600;
  text-decoration: none;
  cursor: pointer;
  transition: background-color 0.2s ease;
}

.whatsapp-btn:hover {
  background: #1ebc57;
}
```

**Step 4: Remove unused complex styles (gradients, shadows, animations)**

Remove:
- `background: linear-gradient(...)` → replace with solid colors
- `box-shadow: 0 4px 12px...` → replace with `border: 1px solid #e5e5e5`
- Animations that aren't essential

**Step 5: Commit**

```bash
git add resources/js/components/ProductDetail.vue
git commit -m "feat: simplify product detail styles"
```

---

### Task 4: Test and Verify

**Step 1: Start dev server**

```bash
npm run dev
```

**Step 2: Check in browser**
- Navigate to a product detail page
- WhatsApp button visible and links correctly
- Clean layout matches CCTV store aesthetic

**Step 3: Commit final**

```bash
git add resources/js/components/ProductDetail.vue
git commit -m "feat: complete product detail redesign"
```