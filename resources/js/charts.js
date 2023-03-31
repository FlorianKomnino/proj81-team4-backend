import Chart from 'chart.js/auto';

console.log(visualizations)


let months = ['Apr 2022', 'Mag 2022', 'Giu 2022', 'Lug 2022', 'Ago 2022', 'Set 2022', 'Ott 2022', 'Nov 2022', 'Dic 2022', 'Gen 2023', 'Feb 2023', 'Mar 2023'];

let monthlyVisualizations = [

    {
        month: 'aprile',
        count: 0,
    },
    {
        month: 'maggio',
        count: 0,
    },
    {
        month: 'giugno',
        count: 0,
    },
    {
        month: 'luglio',
        count: 0,
    },
    {
        month: 'agosto',
        count: 0,
    },
    {
        month: 'settembre',
        count: 0,
    },
    {
        month: 'ottobre',
        count: 0,
    },
    {
        month: 'novembre',
        count: 0,
    },
    {
        month: 'dicembre',
        count: 0,
    },
    {
        month: 'gennaio',
        count: 0,
    },
    {
        month: 'febbraio',
        count: 0,
    },
    {
        month: 'marzo',
        count: 0,
    },
]


for (let i = 0; i < visualizations.length; i++) {

    let dateToAnalize = new Date(visualizations[i].created_at.substring(0, 10)).toLocaleString('default', { month: 'long' })

    for (let i = 0; i < monthlyVisualizations.length; i++) {
        if (monthlyVisualizations[i].month == dateToAnalize) {
            monthlyVisualizations[i].count = monthlyVisualizations[i].count + 1
        } else {
        }
    }
}

const ctx = document.getElementById('myChart');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: months,
        datasets: [{
            label: '# of Visualizations',
            data:
                [
                    monthlyVisualizations[0].count,
                    monthlyVisualizations[1].count,
                    monthlyVisualizations[2].count,
                    monthlyVisualizations[3].count,
                    monthlyVisualizations[4].count,
                    monthlyVisualizations[5].count,
                    monthlyVisualizations[6].count,
                    monthlyVisualizations[7].count,
                    monthlyVisualizations[8].count,
                    monthlyVisualizations[9].count,
                    monthlyVisualizations[10].count,
                    monthlyVisualizations[11].count
                ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});