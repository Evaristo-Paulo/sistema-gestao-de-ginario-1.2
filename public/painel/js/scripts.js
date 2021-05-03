var link = document.querySelector('.notify-text .see-debts')
link.addEventListener('click', function (e) {
    window.location.href = '/pagamentos-em-atraso'
})

setTimeout(() => {
    $('.main-content-inner .alert').alert('close').removeClass("fadeInDown").addClass(" fadeOutDown");
}, 4000); //depois de 3 segundos
