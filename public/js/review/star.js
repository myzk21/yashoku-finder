document.addEventListener('DOMContentLoaded', function() {
    const stars = document.querySelectorAll('.review-star');
    let rating = 0;

    stars.forEach((star, index) => {
        star.addEventListener('click', () => {
            rating = index + 1;
            document.getElementById('rating').value = rating;
            updateStarsOnClick(rating);
        });

        star.addEventListener('mouseover', () => {
            updateStarsOnHover(index + 1);
        });

        star.addEventListener('mouseout', () => {
            updateStarsOnHover(rating);
        });
    });

    function updateStarsOnClick(rating) {
        stars.forEach((star, index) => {
            if (index < rating) {
                star.setAttribute('fill', 'orange');
            } else {
                star.setAttribute('fill', 'none');
            }
        });
    }

    function updateStarsOnHover(rating) {
        stars.forEach((star, index) => {
            if (index < rating) {
                star.setAttribute('fill', 'orange');
            } else {
                star.setAttribute('fill', 'none');
            }
        });
    }
});
