document.addEventListener('DOMContentLoaded', () => {
    const slides = document.querySelectorAll('.slider input[type="radio"]');
    let currentSlide = 0;
    const totalSlides = slides.length;
    const slideInterval = 3000; // Tempo de intervalo em milissegundos (3 segundos)

    function goToNextSlide() {
        slides[currentSlide].checked = false; // Desmarca o slide atual
        currentSlide = (currentSlide + 1) % totalSlides; // Calcula o próximo slide
        slides[currentSlide].checked = true; // Marca o próximo slide
    }

    // Muda automaticamente o slide a cada intervalo
    setInterval(goToNextSlide, slideInterval);
});
