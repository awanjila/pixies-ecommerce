<template>
  <div class="subscription-section">
    <div class="subscription-content">
      <h4>Join 1,000+ Vaping Pros Who Receive our Weekly newsletter.</h4>
      <p>Get the most relevant, Vaping insights you need to make smarter decisions faster... all in under five minutes.</p>
      <form action="#" method="post">
        <div class="form-group">
          <input type="text" class="form-control" id="name" placeholder="First Name">
        </div>
        <div class="form-group">
          <input type="email" class="form-control" id="email" placeholder="Enter your email">
        </div>
        <button type="submit" class="btn btn-primary">Subscribe Now</button>
      </form>
    </div>
  </div>
</template>

<style>
.subscription-section {
  position: fixed;
  bottom: 0;
  z-index: 999;
  background: linear-gradient(to bottom, rgba(29, 29, 31, 1), rgba(29, 29, 31, 0.8));
  color: white;
  padding: 30px;
  border-radius: 15px;
  width: 100%;
}

.subscription-content {
  text-align: center;
}

.subscription-content h4 {
  margin-bottom: 20px;
  font-family: var(--fontHeading);
  font-size: 24px;
}

.subscription-content p {
  margin-bottom: 10px;
  font-family: var(--fontSerif);
  font-size: 14px;
}

.form-group {
  margin-bottom: 15px;
}

.form-control {
  background-color: #F6F9FC;
  color: #1d1d1f;
  border-color: #CCCCCC;
  border-radius: 5px;
  padding: 10px;
  width: 100%;
}

.btn-primary {
  background-color: #026fff;
  border-color: #026fff;
  border-radius: 5px;
  width: 100%;
  color: white;
  padding: 10px;
  font-size: 16px;
}

.btn-primary:hover {
  background-color: darkblue;
  border-color: darkblue;
}

@media (min-width: 768px) {
  .subscription-section {
    position: absolute;
    top: 50%;
    right: 0;
    transform: translateY(-50%);
    width: 300px;
  }
}
</style>
