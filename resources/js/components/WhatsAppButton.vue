<template>
    <a href="https://wa.me/254798742543" 
       target="_blank" 
       class="whatsapp-button"
       title="Chat with us on WhatsApp">
        <i class="fab fa-whatsapp"></i>
    </a>
</template>

<script>
export default {
    name: 'WhatsAppButton'
}
</script>

<style scoped>
.whatsapp-button {
    position: fixed;
    bottom: 20px;
    right: 20px;
    background-color: #25D366;
    color: white;
    width: 60px;
    height: 60px;
    border-radius: 50%;
    text-align: center;
    font-size: 30px;
    box-shadow: 2px 2px 3px #999;
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    z-index: 100;
    transition: all 0.3s ease;
}

.whatsapp-button:hover {
    background-color: #128C7E;
    transform: scale(1.1);
}

.fa-whatsapp {
    font-size: 36px;
}

@media screen and (max-width: 768px) {
    .whatsapp-button {
        width: 50px;
        height: 50px;
        font-size: 25px;
    }
    
    .fa-whatsapp {
        font-size: 30px;
    }
}
</style> 