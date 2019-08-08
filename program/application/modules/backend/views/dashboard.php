<!DOCTYPE html>

<html lang="en">
    <head>
        <?php $this->load->view('include/head');?>
        <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/backend/css/jquery.jqplot.css" />
        <style type="text/css">
            .total-visits{font-size: 18px;text-align: right;}
        </style>
    </head>

    <body>
        <?php $this->load->view('include/menu');?>
        <div class="container-fluid min-content">
            <div class="row-fluid">
                <div class="span6">
                    <h2>Welcome <?=full_name_en()?></h2>
                    <p>Your last loggedin date : <?=lastlogin_en()?></p>
                </div>
            </div>

            <div class="row-fluid">
                <div class="span12" style="height:170px;width:100%;text-align: center">
                    <!-- <h2> Perancangan sistem informasi tiket helpdesk pada PT Artajasa</h2> -->
                    <h3> PERANCANGAN SISTEM INFORMASI TIKET HELPDESK PADA PT ARTAJASA </h3>
                    <a class="brand logo" target="_blank" href="#"><img src="<?=base_url()?>assets/backend/img/logo-art.png" border="0" width="350px" /></a>
                </div>

            </div>

        </div>

        <?php $this->load->view('include/footer');?>

        <script type="text/javascript" src="<?=base_url()?>assets/backend/js/jquery.jqplot.min.js"></script>
        <script type="text/javascript" src="<?=base_url()?>assets/backend/plugins/jqplot.highlighter.min.js"></script>
        <script type="text/javascript" src="<?=base_url()?>assets/backend/plugins/jqplot.cursor.min.js"></script>
        <script type="text/javascript" src="<?=base_url()?>assets/backend/plugins/jqplot.dateAxisRenderer.min.js"></script>
        <script type="text/javascript" src="<?=base_url()?>assets/backend/plugins/jqplot.pieRenderer.min.js"></script>
        <script type="text/javascript" src="<?=base_url()?>assets/backend/plugins/jqplot.categoryAxisRenderer.min.js"></script>
        <script type="text/javascript" src="<?=base_url()?>assets/backend/plugins/jqplot.barRenderer.min.js"></script>

        <script class="code" type="text/javascript">

            $(document).ready(function(){
                // chartDaily();
                chartBrowser();
                chartOs();
            });

            $(window).resize(function() {
                chartDaily();
                chartBrowser();
                chartOs();
            });

            function chartOs()
            {
                $('#chart-os').html('');
                var line = [<?=$os?>];

                $('#chart-os').jqplot([line], {
                    title:'Operating System',
                    seriesDefaults:{
                        renderer:$.jqplot.BarRenderer,
                        rendererOptions: {
                            // Set the varyBarColor option to true to use different colors for each bar.
                            // The default series colors are used.
                            varyBarColor: true
                        }
                    },

                    axes:{
                        xaxis:{
                            renderer: $.jqplot.CategoryAxisRenderer
                        }

                    }

                });

            }

            function chartBrowser()
            {
                $('#chart-browser').html('');
                var line = [<?=$browser?>];

                var plot = $.jqplot('chart-browser', [line], {
                    grid: {
                        drawBorder: false,
                        drawGridlines: false,
                        background: '#ffffff',
                        shadow:false
                    },

                    axesDefaults: {

                    },

                    seriesDefaults:{
                        renderer:$.jqplot.PieRenderer,
                        rendererOptions: {
                            showDataLabels: true
                        }

                    },

                    legend: {
                        show: true,
                        rendererOptions: {
                            numberRows: 1
                        },
                        location: 's'
                    }

                });

            }

            function chartDaily()
            {
                $('#chart-daily').html('');


                var line=[<?=$daily?>];
                var daily = $.jqplot('chart-daily', [line], {
                    title:'Daily visits',
                    axes:{
                      xaxis:{
                        renderer:$.jqplot.DateAxisRenderer,
                          tickOptions:{
                            formatString:'%b&nbsp;%#d'
                          }
                      }
                    },

                    highlighter: {
                      show: false
                    },

                    cursor: {
                      show: true,
                      tooltipLocation:'sw'
                    }

                  });

            }

        </script>

    </body>

</html>
