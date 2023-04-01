import Chart from 'chart.js/auto';

console.log(apartments[0].visualizations)

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

function createGraph(myChart, visualizationsToRender) {

    for (let i = 0; i < visualizationsToRender.length; i++) {

        let dateToAnalize = new Date(visualizationsToRender[i].created_at.substring(0, 10)).toLocaleString('default', { month: 'long' })

        for (let i = 0; i < monthlyVisualizations.length; i++) {
            if (monthlyVisualizations[i].month == dateToAnalize) {
                monthlyVisualizations[i].count = monthlyVisualizations[i].count + 1
            } else {
            }
        }
    }

    let resultingVisualizations = [
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
    ]

    const createdGraph = document.getElementById(myChart);
    new Chart(createdGraph, {
        type: 'line',
        data: {
            labels: months,
            datasets: [{
                label: 'Numero di visualizzazioni',
                data: resultingVisualizations,
                borderWidth: 1,
                borderColor: '#ff4859dd',
                backgroundColor: '#ff485977',

                pointStyle: 'circle',
                pointRadius: 6,
                pointHoverRadius: 15
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            font: {
                size: 20
            },
            responsive: true,
            plugins: {
                title: {
                    text: (createdGraph) => 'Point Style: ' + createdGraph.chart.data.datasets[0].pointStyle,
                }
            }
        }
    });

    monthlyVisualizations[0].count = 0;
    monthlyVisualizations[1].count = 0;
    monthlyVisualizations[2].count = 0;
    monthlyVisualizations[3].count = 0;
    monthlyVisualizations[4].count = 0;
    monthlyVisualizations[5].count = 0;
    monthlyVisualizations[6].count = 0;
    monthlyVisualizations[7].count = 0;
    monthlyVisualizations[8].count = 0;
    monthlyVisualizations[9].count = 0;
    monthlyVisualizations[10].count = 0;
    monthlyVisualizations[11].count = 0;
}

let testApartment = apartments[0].visualizations;

let totalVisualizations = [];

for (let iOut = 0; iOut < apartments.length; iOut++) {
    for (let iIn = 0; iIn < apartments[iOut].visualizations.length; iIn++) {
        totalVisualizations.push(apartments[iOut].visualizations[iIn])
    }
}


createGraph('myChart', totalVisualizations);

for (let i = 0; i < apartments.length; i++) {
    let apartmentVisualizations = apartments[i].visualizations;
    createGraph(i, apartmentVisualizations);
}
