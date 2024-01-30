$(document).ready(function() {
    $("#advanceLeagueBtn").click(function() {
        var messages = [
            "Takımlar sahaya çıkıyor!",
            "Ve maç başladı, ilk dakikalar çok heyecanlı!",
            "Orta sahadan müthiş bir pas...",
            "Gooooool! İnanılmaz bir vuruş!",
            "İlk yarı sona eriyor, nefesler tutulmuş durumda.",
            "İkinci yarı başlıyor, takımlar hücumda daha etkili.",
            "Kaleci kurtarıyor, seyirciler ayakta!",
            "Ve maç bitti."
        ];
        var index = 0;

        var animationDiv = $("#animationDiv");
        var animationDivText = $("#animationDiv .text");
        animationDiv.removeClass("hidden").addClass("animated");

        var interval = setInterval(function() {
            if (index < messages.length) {
                animationDivText.text(messages[index++]);
            } else {
                clearInterval(interval);
                setTimeout(function() {
                    window.location.href = $("#advanceLeagueBtn").data('url');
                }, 2000);
            }
        }, 1500);
    });
});
