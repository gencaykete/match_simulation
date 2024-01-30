# Futbol Ligi Simülasyonu

Bu proje, PHP ve Laravel framework kullanılarak geliştirilmiş bir futbol ligi simülasyonudur. Proje, bir ligde bulunan takımlar arasında maçlar oynatarak ve sonuçlarını takip ederek, bir futbol ligi sezonunu simüle etmektedir.

## Özellikler

- **Maç Simülasyonu**: Takımlar arasındaki maçları simüle etme.
- **Güç Değerleri**: Her takıma özgü güç değerleri.
- **Otomatik Puan Tablosu Güncellemesi**: Maç sonuçlarına göre puan tablosunun otomatik güncellenmesi.
- **Haftalık İlerleme ve Lig Bitirme**: Maçları haftalık oynatabilme ve tüm ligi bir anda tamamlama yeteneği.
- **Şampiyonluk İhtimalleri**: 4. haftadan sonra takımların şampiyonluk ihtimallerini hesaplama.

## Kurulum

Projeyi yerel olarak kurmak için aşağıdaki adımları izleyin:

1. Projeyi GitHub'dan klonlayın: `git clone https://github.com/gencaykete/match.git`

2. Bağımlılıkları yükleyin: `composer install`

3. `.env` dosyasını oluşturun ve veritabanı ayarlarınızı yapılandırın.

4. Veritabanı tablolarını oluşturmak ve başlangıç verileriyle doldurmak için migration ve seed işlemlerini gerçekleştirin: `php artisan migrate --seed`

# Maç Simülasyonu

```
    private function simulateMatchResult($homeTeamStrength, $awayTeamStrength): array
    {
        $homeTeamScore = 0;
        $awayTeamScore = 0;

        // Her iki takım için 90 dakika boyunca gol şansını hesapla
        for ($i = 0; $i < 90; $i++) {
            // Burdaki $homeTeamStrength * 1.10 ev sahibi takımın kazanma oranını %10 arttırmak için
            if (rand(0, 100) < $homeTeamStrength * 1.10) {
                $homeTeamScore++;
            }
            if (rand(0, 100) < $awayTeamStrength) {
                $awayTeamScore++;
            }
        }

        return ['homeScore' => $homeTeamScore, 'awayScore' => $awayTeamScore];
    }
```

# Şampiyonluk Hesabı

```
    public function calculateChampionshipProbabilities()
    {
        // Kalan maç sayısını
        $remaining_matches = 6 - Standing::getCurrentWeek();
        $teams = Team::all();
        // Kalan maç sayısına göre tüm takımların alabileceği puanı hesapladık
        $totalPointsAvailable = $this->calculateTotalPointsAvailable($teams, $remaining_matches);

        $championshipProbabilities = [];
        foreach ($teams as $team) {
            // Oynadığı her maçı kazanma ihtimalini düşündüm
            $maxPossiblePoints = $team->standing->points + ($remaining_matches * 3);
            // Maksimumum alabileceği puanın kazanaılabilecek tüm puanına göre oranını aldım
            $championshipProbabilities[$team->id] = $maxPossiblePoints / $totalPointsAvailable * 100;
        }

        return floor($championshipProbabilities[$this->id]);
    }

    private function calculateTotalPointsAvailable($teams, $remaining_matches)
    {
        $totalPoints = 0;
        foreach ($teams as $team) {
            $totalPoints += $team->standing->points + ($remaining_matches * 3);
        }
        return $totalPoints;
    }
```
