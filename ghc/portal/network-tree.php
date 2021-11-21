<?php
session_start(); ob_start();

include("library/connect.inc.php");
chkLogin();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="../plugins/images/favicon.png">
    <title>Network Tree</title>
    <!-- ===== Bootstrap CSS ===== -->
    <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- ===== Plugin CSS ===== -->
    <link href="../plugins/components/chartist-js/dist/chartist.min.css" rel="stylesheet">
    <link href="../plugins/components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css" rel="stylesheet">
    <!-- ===== Animation CSS ===== -->
    <link href="css/animate.css" rel="stylesheet">
    <!-- ===== Custom CSS ===== -->
    <link href="css/style.css" rel="stylesheet">
    <!-- ===== Color CSS ===== -->
    <link href="css/colors/blue.css" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="mini-sidebar">
    <!-- ===== Main-Wrapper ===== -->
    <div id="wrapper">
     <!--   <div class="preloader">
            <div class="cssload-speeding-wheel"></div>
        </div>  --->
        <!-- ===== Top-Navigation ===== -->
<?php include ("topnav.php"); ?>
        <!-- ===== Top-Navigation-End ===== -->
        <!-- ===== Left-Sidebar ===== -->
 <?php include ("aside.php"); ?>
        <!-- ===== Left-Sidebar-End ===== -->
        <!-- ===== Page-Content ===== -->
        <div class="page-wrapper">
         


 <div class="row">
                    
                        <div class="white-box">
                            <b>Network Tree</b>
                            <div class="table-responsive">
                              
                               <?php include("gtreee.php"); ?>
                               <a href="?#">RESET</a>
                            </div>
                        
                    </div>
                </div>


              
            
            <!-- ===== Page-Container-End ===== -->
            <?php include("footer.php"); ?>
        </div>
        <!-- ===== Page-Content-End ===== -->
  
    <!-- ===== Main-Wrapper-End ===== -->
    <!-- ==============================
        Required JS Files
    =============================== -->
    <!-- ===== jQuery ===== -->
    <script src="../plugins/components/jquery/dist/jquery.min.js"></script>
    <!-- ===== Bootstrap JavaScript ===== -->
    <script src="bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- ===== Slimscroll JavaScript ===== -->
    <script src="js/jquery.slimscroll.js"></script>
    <!-- ===== Wave Effects JavaScript ===== -->
    <script src="js/waves.js"></script>
    <!-- ===== Menu Plugin JavaScript ===== -->
    <script src="js/sidebarmenu.js"></script>
    <!-- ===== Custom JavaScript ===== -->
    <script src="js/custom.js"></script>
    <!-- ===== Plugin JS ===== -->
    <script src="../plugins/components/chartist-js/dist/chartist.min.js"></script>
    <script src="../plugins/components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js"></script>
    <script src="../plugins/components/sparkline/jquery.sparkline.min.js"></script>
    <script src="../plugins/components/sparkline/jquery.charts-sparkline.js"></script>
    <script src="../plugins/components/knob/jquery.knob.js"></script>
    <script src="../plugins/components/easypiechart/dist/jquery.easypiechart.min.js"></script>
    <script type="text/javascript">
        $(function() {
    "use strict";

    /* ===== Knob chart initialization ===== */

    $(function() {

        $('.knob').each(function() {

            var elm = $(this);
            var perc = elm.attr("value");

            elm.knob();

            $({ value: 0 }).animate({ value: perc }, {
                duration: 1000,
                easing: 'swing',
                progress: function() {
                    elm.val(Math.ceil(this.value)).trigger('change')
                }
            });
        });
    });

    /* ===== Statistics chart ===== */

    var chart1 = new Chartist.Line('.stat', {
        labels: [<?php echo $profile->chartMonth() ?>],
        series: [
            [<?php echo $profile->monthEntryData() ?>],
            [<?php echo $profile->monthUserSponsor() ?>]
        ]
    }, {
        high: <?php echo $profile->maxMonthly() ?>,
        low: 0,
        height: '278px',
        showArea: false,
        fullWidth: true,
        axisY: {
            onlyInteger: true,
            showGrid: true,
            offset: 20,
        },
        plugins: [
            Chartist.plugins.tooltip()
        ]
    });

    /* ===== Visits chart ===== */

    var chart2 = new Chartist.Bar('.ct-visit', {
        labels: [1, 2, 3],
        series: [50, 70, 60]
    }, {
        distributeSeries: true,
        chartPadding: {
            left: -20,
            right: -10
        },
        axisX: {
            showLabel: true,
            showGrid: false
        },
        axisY: {
            showLabel: false,
            showGrid: false
        },
        plugins: [
            Chartist.plugins.tooltip()
        ]
    });

    /* ===== Revenue chart ===== */

    var chart3 = new Chartist.Line('.ct-revenue', {
        labels: [0, 1, 2, 3, 4, 5, 6, 7],
        series: [
            [0, 3, 5, 3, 2, 4, 7, 6]
        ]
    }, {
        chartPadding: {
            left: 0,
            top: 10,
        },
        low: 1,
        showPoint: true,
        height: '100px',
        fullWidth: true,
        axisX: {
            showLabel: true,
            showGrid: true
        },
        axisY: {
            showLabel: true,
            showGrid: true
        },
        showArea: true,
        plugins: [
            Chartist.plugins.tooltip()
        ]
    });

    var chart = [chart1, chart2, chart3];

    for (var i = 0; i < chart.length; i++) {
        chart[i].on('draw', function(data) {
            if (data.type === 'line' || data.type === 'area') {
                data.element.animate({
                    d: {
                        begin: 500 * data.index,
                        dur: 500,
                        from: data.path.clone().scale(1, 0).translate(0, data.chartRect.height()).stringify(),
                        to: data.path.clone().stringify(),
                        easing: Chartist.Svg.Easing.easeInOutElastic
                    }
                });
            }
            if (data.type === 'bar') {
                data.element.animate({
                    y2: {
                        dur: 500,
                        from: data.y1,
                        to: data.y2,
                        easing: Chartist.Svg.Easing.easeInOutElastic
                    },
                    opacity: {
                        dur: 500,
                        from: 0,
                        to: 1,
                        easing: Chartist.Svg.Easing.easeInOutElastic
                    }
                });
            }
        });
    }

    $("#earning").easyPieChart({
        barColor: "#4da8db",
        trackColor: !1,
        scaleColor: !1,
        scaleLength: 0,
        lineCap: "square",
        lineWidth: 12,
        size: 96,
        rotate: 180,
        animate: { duration: 2e3, enabled: !0 }
    });
    $("#pending").easyPieChart({
        barColor: "#4db7df",
        trackColor: !1,
        scaleColor: !1,
        scaleLength: 0,
        lineCap: "square",
        lineWidth: 12,
        size: 74,
        rotate: 180,
        animate: { duration: 2e3, enabled: !0 }
    });
    $("#booking").easyPieChart({
        barColor: "#4ccfe4",
        trackColor: !1,
        scaleColor: !1,
        scaleLength: 0,
        lineCap: "square",
        lineWidth: 12,
        size: 50,
        rotate: 180,
        animate: { duration: 2e3, enabled: !0 }
    });
});

    </script>
    <!-- ===== Style Switcher JS ===== -->
    <script src="../plugins/components/styleswitcher/jQuery.style.switcher.js"></script>
</body>

</html>
