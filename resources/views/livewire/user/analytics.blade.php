<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Budget Overview</h5>
                    <div id="budgetChart" style="width: 100%; height: 500px;"></div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Add Budget Requests</h5>
                    <div id="addBudgetChart" style="width: 100%; height: 500px;"></div>
                </div>
            </div>
        </div>

        <!-- Repeat the pattern for other charts -->
        <!-- Sales Chart -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Sales Data from Laravel</h5>
                    <div id="salesChart" style="width: 100%; height: 500px;"></div>
                </div>
            </div>
        </div>

        <!-- Turnover Chart -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Turnover Chart</h5>
                    <div id="turnoverChart" style="width: 100%; height: 500px;"></div>
                </div>
            </div>
        </div>

        <!-- Recievable Chart -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Recievable Chart</h5>
                    <div id="recievableChart" style="width: 100%; height: 500px;"></div>
                </div>
            </div>
        </div>

        <!-- Payable Chart -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Payable Chart</h5>
                    <div id="payableChart" style="width: 100%; height: 500px;"></div>
                </div>
            </div>
        </div>

        <!-- Payable and Recievable Chart -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Payable and Recievable Chart</h5>
                    <div id="payableAndRecievableChart" style="width: 100%; height: 500px;"></div>
                </div>
            </div>
        </div>

        <!-- Balance Chart -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Balance Sheet Composition</h5>
                    <div id="balanceChart" style="width: 100%; height: 500px;"></div>
                </div>
            </div>
        </div>

        <!-- Cashflow Chart -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Cashflow Chart</h5>
                    <div id="cashflowChart" style="width: 100%; height: 500px;"></div>
                </div>
            </div>
        </div>

        <!-- Income Chart -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Income Chart</h5>
                    <div id="incomeChart" style="width: 100%; height: 500px;"></div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function getRandomColor() {
            var colors = ['#7366FF', '#FF3364'];
            return colors[Math.floor(Math.random() * colors.length)];
        }

        function getRandomColors(count) {
            var colors = [];
            var letters = '0123456789ABCDEF';
            for (var j = 0; j < count; j++) {
                var color = '#';
                for (var i = 0; i < 6; i++) {
                    color += letters[Math.floor(Math.random() * 16)];
                }
                colors.push(color);
            }
            return colors;
        }

        // Get random color
        var randomColor = getRandomColor();
        var randomColors = getRandomColors(10);

        // Get data from Laravel
        var budgetData = @json($budgetData);
        var addBudgetData = @json($addBudgetData);
        var salesData = @json($salesData);
        var turnoverData = @json($turnoverData);
        var recievableData = @json($recievableData);
        var payableData = @json($payableData);
        var balanceData = @json($balanceData);
        var cashflowData = @json($cashflowData);
        var incomeData = @json($incomeData);

        // Initiate Charts
        var budgetChart = echarts.init(document.getElementById('budgetChart'));
        var addBudgetChart = echarts.init(document.getElementById('addBudgetChart'));
        var salesChart = echarts.init(document.getElementById('salesChart'));
        var turnoverChart = echarts.init(document.getElementById('turnoverChart'));
        var recievableChart = echarts.init(document.getElementById('recievableChart'));
        var payableChart = echarts.init(document.getElementById('payableChart'));
        var payableAndRecievableChart = echarts.init(document.getElementById('payableAndRecievableChart'));
        var balanceChart = echarts.init(document.getElementById('balanceChart'));
        var cashflowChart = echarts.init(document.getElementById('cashflowChart'));
        var incomeChart = echarts.init(document.getElementById('incomeChart'));

        // Budget Chart
        var budgetXAxisData = budgetData.map(item => item.budget_name);
        var budgetSeriesData = budgetData.map(item => item.budget_approvedAmount);

        var budgetOption = {
            color: [randomColor],
            xAxis: {
                type: 'category',
                data: budgetXAxisData
            },
            yAxis: {
                type: 'value'
            },
            series: [{
                data: budgetSeriesData,
                type: 'bar'
            }]
        };

        budgetChart.setOption(budgetOption);

        // Add Budget Chart
        var addBudgetXAxisData = addBudgetData.map(item => item.request_name);
        var addBudgetSeriesData = addBudgetData.map(item => item.request_approvedAmount);

        var addBudgetOption = {
            color: [randomColor],
            xAxis: {
                type: 'category',
                data: addBudgetXAxisData
            },
            yAxis: {
                type: 'value'
            },
            series: [{
                data: addBudgetSeriesData,
                type: 'bar'
            }]
        };

        addBudgetChart.setOption(addBudgetOption);

        // Sales chart
        var xAxisData = salesData.map(item => item.sales_product_name);
        var seriesData = salesData.map(item => item.sales_revenue);

        var salesOption = {
            color: [randomColor],
            tooltip: {},
            xAxis: {
                data: xAxisData
            },
            yAxis: {},
            series: [{
                name: 'sales',
                type: 'bar',
                data: seriesData
            }]
        };

        salesChart.setOption(salesOption);

        // Turnover chart
        var xAxisData = turnoverData.map(item => item.turnover_product_name);
        var seriesData = turnoverData.map(item => item.turnover_cost_of_goods_sold);

        var turnoverOption = {
            color: [randomColor],
            xAxis: {
                type: 'category',
                data: xAxisData
            },
            yAxis: {
                type: 'value'
            },
            series: [{
                data: seriesData,
                type: 'line',
                smooth: true
            }]
        };

        turnoverChart.setOption(turnoverOption);


        //recievable chart
        var xAxisData = recievableData.map(item => item.recievable_invoice_date);
        var seriesData = recievableData.map(item => item.recievable_amount);

        var recievableOption = {
            color: [randomColor],
            xAxis: {
                type: 'category',
                boundaryGap: false,
                data: xAxisData
            },
            yAxis: {
                type: 'value'
            },
            series: [{
                data: seriesData,
                type: 'line',
                areaStyle: {}
            }]
        };

        recievableChart.setOption(recievableOption);

        //payable chart
        var xAxisData = payableData.map(item => item.payable_date);
        var seriesData = payableData.map(item => item.payable_amount);

        var payableOption = {
            color: [randomColor],
            xAxis: {
                type: 'category',
                boundaryGap: false,
                data: xAxisData
            },
            yAxis: {
                type: 'value'
            },
            series: [{
                data: seriesData,
                type: 'line',
                areaStyle: {}
            }]
        };

        payableChart.setOption(payableOption);

        // payable and recievable chart
        var payableXAxis = payableData.map(item => item.payable_date);
        var payableSeries = payableData.map(item => item.payable_amount);

        var recievableXAxis = recievableData.map(item => item.recievable_invoice_date);
        var recievableSeries = recievableData.map(item => item.recievable_amount);

        var payableAndRecievableOption = {
            color: randomColors,
            xAxis: {
                type: 'category',
                boundaryGap: false,
                data: payableXAxis.concat(recievableXAxis)
            },
            yAxis: {
                type: 'value'
            },
            series: [{
                    name: 'Payables',
                    data: payableSeries,
                    type: 'line',
                    areaStyle: {}
                },
                {
                    name: 'Recievables',
                    data: recievableSeries,
                    type: 'line',
                    areaStyle: {}
                }
            ]
        };

        payableAndRecievableChart.setOption(payableAndRecievableOption);

        //cashflow chart
        var xAxisData = cashflowData.map(item => item.cashflow_name);
        var seriesData = cashflowData.map(item => item.cashflow_amount);

        var cashflowOption = {
            color: [randomColor],
            xAxis: {
                type: 'category',
                data: xAxisData
            },
            yAxis: {
                type: 'value'
            },
            series: [{
                name: 'Cash Flow',
                type: 'bar',
                stack: 'total',
                label: {
                    show: true,
                    position: 'inside'
                },
                data: seriesData
            }]
        };

        cashflowChart.setOption(cashflowOption);

        //blance chart
        var legendData = balanceData.map(item => item.balance_name);
        var seriesData = balanceData.map(item => ({
            name: item.balance_name,
            value: item.balance_amount
        }));

        var balanceOption = {
            color: randomColors,
            legend: {
                data: legendData
            },
            tooltip: {
                trigger: 'item',
                formatter: '{a} <br/>{b}: ₱{c} ({d}%)'
            },
            series: [{
                name: 'Balance Sheet',
                type: 'pie',
                radius: '55%',
                center: ['50%', '60%'],
                data: seriesData,
                emphasis: {
                    itemStyle: {
                        shadowBlur: 10,
                        shadowOffsetX: 0,
                        shadowColor: 'rgba(0, 0, 0, 0.5)'
                    }
                }
            }]
        };

        balanceChart.setOption(balanceOption);

        // income chart
        var xAxisData = incomeData.map(item => item.income_date);
        var seriesData = [{
                name: 'Sales Revenue',
                type: 'line',
                stack: 'total',
                data: incomeData.map(item => item.income_amount),
                areaStyle: {}
            },
            {
                name: 'Cost of Goods Sold',
                type: 'line',
                stack: 'total',
                data: incomeData.map(item => -item.income_amount), // Negative values for expenses
                areaStyle: {}
            },
            {
                name: 'Gross Profit',
                type: 'line',
                stack: 'total',
                data: incomeData.map(item => item.income_amount),
                areaStyle: {}
            },
            {
                name: 'Expenses',
                type: 'line',
                stack: 'total',
                data: incomeData.map(item => -item.income_amount), // Negative values for expenses
                areaStyle: {}
            }
        ];

        var incomeOption = {
            color: randomColors,
            xAxis: {
                type: 'category',
                boundaryGap: false,
                data: xAxisData
            },
            yAxis: {
                type: 'value'
            },
            series: seriesData
        };

        incomeChart.setOption(incomeOption);
    </script>
</div>
