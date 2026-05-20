document.addEventListener('DOMContentLoaded', function () {
    console.log("DOM loaded"); // Cek di console F12, apakah tulisan ini muncul?

    const activeCard = document.querySelector('.main-card.active');
    console.log("Kartu aktif ditemukan:", activeCard); // Cek apakah ini null

    if (activeCard) {
        const targetId = activeCard.getAttribute('data-target');
        const targetLabel = activeCard.querySelector('h3').innerText;
        
        console.log("Target ID:", targetId); // Cek apakah ID yang diambil benar

        document.querySelectorAll('.illustration-item').forEach(item => {
            item.classList.remove('active');
        });

        const targetIllustration = document.getElementById(targetId);
        if (targetIllustration) {
            targetIllustration.classList.add('active');
            console.log("Class active ditambahkan ke:", targetId);
        } else {
            console.error("Elemen dengan ID " + targetId + " tidak ditemukan!");
        }

        const tabLabel = document.querySelector('.tab-label');
        if (tabLabel) {
            tabLabel.innerText = targetLabel;
        }
    }
});