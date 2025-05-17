document.addEventListener('DOMContentLoaded', async () => {
    const ctx = document.getElementById('salesChart').getContext('2d');
    const year = document.querySelector('select[name="year"]')?.value || new Date().getFullYear();
    const uri = `api/sales/month.php?year=${year}`;

    try {
        const response = await fetch(uri);
        if (!response.ok) {
            throw new Error('通信エラー');
        }

        const monthlySales = await response.json();

        if (monthlySales.length === 0) {
            return;
        }

        // 月別売上データの合計
        const totalSales = monthlySales.reduce((acc, sales) => acc + sales, 0);
        document.getElementById('total-sales').textContent = totalSales.toLocaleString();

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月'],
                datasets: [{
                    label: '月別売上（円）',
                    data: monthlySales,
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: value => value.toLocaleString() + ' 円'
                        }
                    }
                }
            }
        });

    } catch (error) {
        console.error('売上データ取得エラー:', error);
    }
});