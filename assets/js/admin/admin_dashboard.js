$(document).ready(function(){

    //Deployed Chart
    $.ajax({
        url: 'get_deployed_count_per_month',
        method: 'POST',
        dataType: 'JSON',

        success: function(response){
            switch(response.status){
                case 'success':
                    const ctx = document.getElementById('deployed-chart').getContext('2d');

                    new Chart(ctx, {
                        type: 'line', // Can be 'line', 'bar', etc.
                        data: {
                            labels: response.months,
                            datasets: [{
                                label: 'Number of deployments per month',
                                data: response.counts,
                                backgroundColor: 'rgba(57, 175, 209, 0.2)',
                                borderColor: 'rgba(57, 175, 209, 1)',
                                borderWidth: 1,
                                pointStyle: 'rectRot',
                                pointRadius: 10
                            }]
                        },
                        options: {
                            responsive: true,
                            scales: {
                                y: {
                                    beginAtZero: true,
                                }
                            },
                            plugins: {
                                datalabels: {
                                    display: false, // Disable data labels
                                }
                            },

                            onClick: function(event, elements) {
                                const points = this.getElementsAtEventForMode(event, 'nearest', { intersect: true }, true);
                                console.log(points);
                    
                                if (points.length) {
                                    const firstPoint = points[0];
                                    const pointIndex = firstPoint.index;
                                    window.location.href = response.links[pointIndex];
                                }
                            }
                        } 
                    });
                break;

                case 'error':
                    alert('Something went wrong. Please contact IT administrator.');
                break;
            }
        }
    })

     //Weekly Batch Transfers Chart
    $.ajax({
        url: 'get_transfers_per_week_of_current_year',
        method: 'POST',
        dataType: 'JSON',


        success: function(response){
            switch(response.status){
                case 'success':
                    const ctx = document.getElementById('current-week-batch-transfers-chart').getContext('2d');
                    new Chart(ctx, {
                        type: 'line', // Can be 'line', 'bar', etc.
                        data: {
                            labels: response.weeks,
                            datasets: [{
                                label: 'Number of Transfered Trainees per Week',
                                data: response.counts,
                                backgroundColor: 'rgba(255, 99, 71, 0.2)',
                                borderColor: 'rgba(255, 99, 71, 1)',
                                borderWidth: 1,
                                pointStyle: 'rectRot',
                                pointRadius: 10
                            }]
                        },
                        options: {
                            responsive: true,
                            scales: {
                                y: {
                                    beginAtZero: true,
                                }
                            },
                            plugins: {
                                datalabels: {
                                    display: false, // Disable data labels
                                }
                            }
                        }
                    });
                break;

                case 'error':
                    alert('Something went wrong. Please contact IT administrator.');
                break;
            }
        }
    })

     //Daily Batch Transfers Chart per week
    $.ajax({
        url: 'get_daily_transfers_current_week',
        method: 'POST',
        dataType: 'JSON',


        success: function(response){
            switch(response.status){
                case 'success':
                    const ctx = document.getElementById('daily-batch-transfers-per-week-chart').getContext('2d');
                    new Chart(ctx, {
                        type: 'bar', // Can be 'line', 'bar', etc.
                        data: {
                            labels: [
                                "Monday",
                                "Tuesday",
                                "Wednesday",
                                "Thursday",
                                "Friday",
                                "Saturday",
                                "Sunday"
                              ],
                            datasets: [
                                {
                                    label: 'Current Week',
                                    data: response.data.currentWeek.currentCounts,
                                    backgroundColor: 'rgba(57, 175, 209, 0.2)',
                                    borderColor: 'rgba(57, 175, 209, 1)',
                                    borderWidth: 1,
                                    pointStyle: 'rectRot',
                                    pointRadius: 10
                                },
                                {
                                    label: 'Previous Week',
                                    data: response.data.previousWeek.currentCounts,
                                    backgroundColor: 'rgba(255, 99, 71, 0.2)',
                                    borderColor: 'rgba(255, 99, 71, 1)',
                                    borderWidth: 1,
                                    pointStyle: 'rectRot',
                                    pointRadius: 10
                                }
                            ]
                        },
                        options: {
                            responsive: true,
                            scales: {
                                y: {
                                    beginAtZero: true,
                                }
                            },
                            plugins: {
                                datalabels: {
                                    display: false, // Disable data labels
                                }
                            }
                        }
                    });
                break;

                case 'error':
                    alert('Something went wrong. Please contact IT administrator.');
                break;
            }
        }
    })
})