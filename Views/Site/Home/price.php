<?php

use Projet\Model\App;

App::setTitle("Nos Prix");
$tabsShow = [0=>'fade-in-left',1=>'fade-in',2=>'fade-in-right'];
$tabsBg = [0=>' bg-dark-gray',1=>' ui-gradient-peach',2=>' bg-dark-gray'];
$tabsActive = [0=>'',1=>' active',2=>''];
$tabsPad = [0=>' class="pr-5"',1=>'',2=>' class="pl-5"'];
?>
<div class="ui-hero hero-sm bg-dark-gray hero-svg-layer-4">
    <div class="container">
        <h1 class="heading">
            Nos Prix
        </h1>
        <p class="paragraph">
            Nous avons déjà developpés de nombreuses applications et travaillés avec de nombreux partenaires.
        </p>
    </div>
</div>
<div class="main" role="main">

    <div id="pricing" class="section bg-light">
        <div class="container">
            <!-- Section Heading -->
            <div class="section-heading center">
                <h2 class="heading text-dark-gray">
                    Cartes de prix
                </h2>
                <p class="paragraph">
                    Evaluation des coûts de nos diverses prestations
                </p>
            </div>

            <?php
            $i=0;
            foreach ($prices1 as $price) {


                echo'
                    <div class="section">
                    <div class="container">
                        <div class="section-heading center">
                            <h2 class="heading text-indigo">
                                '.$price->intitule.'
                            </h2>
                            <p class="paragraph">
                                '.$price->description.'
                            </p>
                        </div><!-- .section-heading -->
                        
                        <div class="ui-pricing-table">
                            <div class="pricing-sidebar">
                                <div class="pricing-header">
                                    <div class="btn-group">
                                        <a class="btn btn-sm ui-gradient-peach price-toggle" data-toggle="monthly_price">Monthly</a>
                                        <a class="btn btn-sm bg-light-gray price-toggle" data-toggle="annual_price">Annual</a>
                                    </div>
                                    <p><i>Save up to 10% when you pay annually.</i></p>
                                </div>
                                <ul class="pricing-items">
                                    <li>Transaction fees</li>
                                    <li>Accounts</li>
                                    <li>Strorage</li>
                                    <li>Daily Backups</li>
                                    <li>24/7 Support</li>
                                    <li>Custom SSL</li>
                                    <li>Unlimited API Calls</li>
                                    <li>Priority Support</li>
                                </ul>
                            </div>
                            <div class="pricing-block">
                                <div class="pricing-header">
                                    <h5 class="price-plan">
                                        Freelancer
                                    </h5>
                                    <div class="price-wrapper text-indigo" data-price_ann="26.95/mo" data-price_mo="29.95/mo">
                                        <span class="curency">$</span>
                                        <span class="price-postfix">'.thousand($price->cout).'</span>
                                        <span class="price-postfix">.95/mo</span>
                                    </div>
                                    <p class="price-description">
                                        '.$price->description.'
                                    </p>
                                </div>
                                <ul class="pricing-items">
                                    <li><i>Transaction fees</i> 0%</li>
                                    <li><i>Accounts</i> Unlimited</li>
                                    <li><i>Strorage</i> 2GB</li>
                                    <li><i>Daily Backups</i> <span class="fa fa-check text-lime"></span></li>
                                    <li><i>24/7 Support</i> <span class="fa fa-check text-lime"></span></li>
                                    <li><i>Custom SSL</i> -</li> 
                                    <li><i>Unlimited API Calls</i> - </li>
                                    <li><i>Priority Support</i> -</li>
                                </ul>
                                <a href="page-contact.html" class="btn btn-arrow bg-gray">
                                    Get Started
                                </a>
                            </div>
                            <div class="pricing-block ui-gray-lighter">
                                
                                <div class="pricing-header">
                                    <h5 class="price-plan">
                                        Start-up
                                    </h5>
                                    <div class="price-wrapper text-indigo" data-price_ann="71.95/mo" data-price_mo="79.95/mo">
                                        <span class="curency">$</span>
                                        <span class="price-postfix">'.thousand($price->cout).'</span>
                                        <span class="price-postfix">.95/mo</span>
                                    </div>
                                    <p class="price-description">
                                        '.$price->description.'
                                    </p>
                                </div>
                                <ul class="pricing-items">
                                    <li><i>Transaction fees</i> 0%</li>
                                    <li><i>Accounts</i> Unlimited</li>
                                    <li><i>Strorage</i> 20GB</li>
                                    <li><i>Daily Backups</i> <span class="fa fa-check text-lime"></span></li>
                                    <li><i>24/7 Support</i> <span class="fa fa-check text-lime"></span></li>
                                    <li><i>Custom SSL</i> <span class="fa fa-check text-lime"></span></li>
                                    <li><i>Unlimited API Calls</i> <span class="fa fa-check text-lime"></span></li>
                                    <li><i>Priority Support</i> -</li>
                                </ul>
                                <a href="page-contact.html" class="btn btn-arrow ui-gradient-green">
                                    Get Started
                                </a>
                            </div>
                            <div class="pricing-block">
                                <div class="pricing-header">
                                    <h5 class="price-plan">
                                        Enterprice
                                    </h5>
                                    <div class="price-wrapper">
                                        <p>
                                        Call <a href="page-pricing.html#" >1-123-321-0123</a> for custom pricing.
                                        </p>
                                    </div>
                                    <p class="price-description">
                                        '.$price->description.'
                                    </p>
                                </div>
                                <ul class="pricing-items">
                                    <li><i>Transaction fees</i> 0%</li>
                                    <li><i>Accounts</i> Unlimited</li>
                                    <li><i>Strorage</i> 10TB</li>
                                    <li><i>Daily Backups</i> <span class="fa fa-check text-lime"></span></li>
                                    <li><i>24/7 Support</i> <span class="fa fa-check text-lime"></span></li>
                                    <li><i>Custom SSL</i> <span class="fa fa-check text-lime"></span></li>
                                    <li><i>Unlimited API Calls</i> <span class="fa fa-check text-lime"></span></li>
                                    <li><i>Priority Support</i> <span class="fa fa-check text-lime"></span></li>
                                </ul>
                                <a href="page-contact.html" class="btn btn-arrow bg-gray">
                                    Get Started
                                </a>
                            </div>
                        </div>
                    </div><!-- .container -->
             </div><!-- .section -->';
            }
            ?>


            <div class="ui-pricing-cards owl-carousel owl-theme mt-5">
                <?php
                $i=0;
                foreach ($prices2 as $price) {
                    echo
                        '
                    <div class="ui-pricing-card animate'.$tabsActive[$i].'" data-show="'.$tabsShow[$i].'">
                        <div class="ui-card ui-curve shadow-lg">
                            <div class="card-header'.$tabsBg[$i].'">
                                <!-- Heading -->
                                <h4 class="heading">'.$price->intitule.'</h4>
                                <!-- Price -->
                                <div class="price text-red">
                                    <span class="curency">XAF</span>
                                    <span class="price">'.thousand($price->cout).'</span>
                                    <span class="period"></span>
                                </div>
                                <h6 class="sub-heading">Coût minimal</h6>
                            </div>
                            <!-- Features -->
                            <div class="card-body">
                                <ul>
                                    <li'.$tabsPad[$i].'>
                                        '.$price->description.'
                                    </li>
                                </ul>
                                <a  href="#newModal" data-toggle="modal" class="btn shadow-md ui-gradient-peach newCommand">Commander</a>
                            </div>
                        </div>
                    </div>
                ';
                    $i++;
                }
                ?>
            </div>

            <div class="ui-pricing-footer">
                <p class="paragraph">
                    Pour plus d'informations et de details contactez nous
                </p>
                <div class="actions">
                    <a href="<?=App::url("contact")?>" class="btn-link btn-arrow">Contactez nous</a><br>
                </div>
            </div><!-- .ui-pricing-footer -->

        </div><!-- .container -->
    </div>
</div>