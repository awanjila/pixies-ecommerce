<template>
  <div class="subscription-section">
    <div class="subscription-content">
      <h4>Stay Updated</h4>
      <p>Subscribe to our newsletter for the latest products and offers.</p>
      <form action="#" method="post" class="subscription-form">
        <input type="email" class="form-control" id="email" placeholder="Enter your email" required>
        <button type="submit" class="btn-submit">Subscribe</button>
      </form>
    </div>
  </div>
</template>

<style scoped>
.subscription-section {
  background: #171616;
  padding: 2.5rem 1.5rem;
  border: 1px solid #2a2a2a;
}

.subscription-content {
  max-width: 500px;
  margin: 0 auto;
  text-align: center;
}

.subscription-content h4 {
  color: #ffffff;
  font-size: 1.25rem;
  font-weight: 600;
  margin: 0 0 0.5rem;
}

.subscription-content p {
  color: #9ca3af;
  font-size: 0.875rem;
  margin: 0 0 1.25rem;
}

.subscription-form {
  display: flex;
  gap: 0.75rem;
}

.form-control {
  flex: 1;
  background-color: #ffffff;
  color: #171616;
  border: 1px solid #e5e5e5;
  padding: 0.75rem 1rem;
  font-size: 0.875rem;
}

.form-control::placeholder {
  color: #999;
}

.form-control:focus {
  outline: none;
  border-color: #95002a;
}

.btn-submit {
  background-color: #95002a;
  color: #ffffff;
  border: none;
  padding: 0.75rem 1.5rem;
  font-size: 0.875rem;
  font-weight: 600;
  cursor: pointer;
  transition: background-color 0.2s ease;
}

.btn-submit:hover {
  background-color: #7a0022;
}

@media (max-width: 480px) {
  .subscription-form {
    flex-direction: column;
  }
  
  .btn-submit {
    width: 100%;
  }
}
</style>