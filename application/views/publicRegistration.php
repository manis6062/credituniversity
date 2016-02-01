<script>
    jQuery(function ($) {
        $("#ssn").mask("999-99-9999");
        $("#dob").mask("99/99/9999");
        $("#phone").mask("(999)-999-9999");
        $("#fax").mask("(999)-999-9999");

    });
</script>

<style type="text/css">
    /*Font Loded*/
    @import url(http://fonts.googleapis.com/css?family=Roboto:400,700);

    #registration .content {
        min-height: 50px;
        font-family: "Droid Sans", sans-serif;
    }

    #registration .content > .body {
        width: 100%;
        padding: 15px;
        position: relative;
    }

    #registration i.form-control-feedback {
        position: absolute;
        top: 35px;
        right: 15px;
        display: block;
        width: 34px;
        height: 34px;
        line-height: 34px;
        text-align: center;
    }

    #radio i.form-control-feedback {
        top: 78%;
        right: 15px;
        display: block;
        width: 34px;
        height: 34px;
        line-height: 34px;
        text-align: center;
        color: red;
    }

    #radio i {
        display: none !important;

    }

    body, .content-wrapper, .content {
        background: darkgray none repeat scroll 0 0;
        font-family: "Droid Sans", sans-serif;
        margin: 50 50 0 0;
        z-index: 800;
        transition: transform 0.3s ease-in-out 0s, margin 0.3s ease-in-out 0s;
        box-sizing: border-box;
    }

    .dropshadow {
        height: auto;
        -webkit-box-shadow: -15px 13px 20px 3px rgba(0, 0, 0, 0.91);
        -moz-box-shadow: -15px 13px 20px 3px rgba(0, 0, 0, 0.91);
        box-shadow: -15px 13px 20px 3px rgba(0, 0, 0, 0.91);
    }

    .gradient {
        background: -webkit-linear-gradient(dodgerblue, cornflowerblue); /* For Safari 5.1 to 6.0 */
        background: -o-linear-gradient(dodgerblue, cornflowerblue); /* For Opera 11.1 to 12.0 */
        background: -moz-linear-gradient(dodgerblue, cornflowerblue); /* For Firefox 3.6 to 15 */
        background: linear-gradient(dodgerblue, cornflowerblue); /* Standard syntax */
    }

    .center {
        margin: auto;
        width: 60%;
        border: 3px solid #8AC007;
        padding: 10px;
    }

    .customCenter {
        display: block;
        margin-left: auto;
        margin-right: auto;
    }

    .btn-custom {
        color: #bdc3c7;
        font-size: 18px;
        border: 1px solid #bdc3c7;
    }

    .btn-custom:hover {
        color: #ffffff;
        border: 1px solid #ffffff;
    }

    /*Font Loded*/

    .btn-custom {
        color: #bdc3c7;
        font-size: 18px;
        border: 1px solid #bdc3c7;
    }

    .btn-custom:hover {
        color: #ffffff;
        border: 1px solid #ffffff;
    }

    body {
        font-family: 'Droid Sans', sans-serif;
        font-weight: 400;
        font-size: 17px;
        line-height: 28px
    }

    p {
        margin-bottom: 20px
    }

    h1, h2, h3, h4, h5, h6 {
        font-family: 'Droid Sans', sans-serif;
        font-weight: 700;
        color: #000
    }

    .btn {
        border-radius: 4px;
        text-transform: uppercase
    }

    .btn-primary {
        background: #659f48;
        border: none;
        border-radius: 4px;
        font-size: 22px;
        text-shadow: 0 1px 0 #578a40;
        color: #fff;
        box-shadow: 0 2px 0 #578a40
    }

    .btn-primary:hover {
        background: #77ae50
    }

    .btn-lg {
        padding: 15px 20px
    }

    .normal {
        font-weight: 400 !important;
        font-weight: 400 !important
    }

    .main-navigation {
        background: #4b6eb2;
        padding: 10px 0;
        border-top: 5px solid #314c7b
    }

    .nav-bar {
        min-height: 59px
    }

    .navbar-default {
        background: #4b6eb2;
        border: none;
        border-radius: 0;
        box-shadow: none;
        margin: 0
    }

    .navbar-brand {
        padding: 0;
        height: 59px
    }

    .navbar-nav {
        margin-top: 10px
    }

    .navbar-default .navbar-nav > li > a {
        color: #fff;
        text-transform: uppercase;
        padding: 7px 15px;
        font-weight: 400
    }

    .navbar-default .navbar-nav > li > a:hover, .navbar-default .navbar-nav > li > a:focus {
        color: rgba(255, 255, 255, 0.8)
    }

    .navbar-default .navbar-nav > .active > a, .navbar-default .navbar-nav > .active > a:hover, .navbar-default .navbar-nav > .active > a:focus {
        background: #659f48;
        color: #fff;
        border-radius: 4px;
        box-shadow: 0 2px 0 #578a40
    }

    .navbar-default .navbar-nav > .active > a:hover {
        background: #77ae50
    }

    .navbar-default .navbar-collapse, .navbar-default .navbar-form {
        border: none;
        box-shadow: none
    }

    .navbar-default .navbar-toggle {
        border: none;
        margin-top: 15px;
        margin-right: 0
    }

    .navbar-default .navbar-toggle .icon-bar {
        background: #fff
    }

    .navbar-default .navbar-toggle:hover, .navbar-default .navbar-toggle:focus {
        background: none
    }

    .heading {
        text-align: center;
        margin-bottom: 40px
    }

    .jumbotron {
        background: #fff;
        background: url(images/home-background3.jpg) no-repeat center 100%;
        background-size: contain;
        height: 800px;
        margin: 0
    }

    .jumbotron h1 {
        font-size: 46px
    }

    .jumbotron span {
        background: url(images/524.png) no-repeat;
        background-size: contain;
        color: transparent
    }

    .jumbotron .lead {
        color: #737373;
        font-size: 20px
    }

    .video-area {
        padding: 40px 0
    }

    .check {
        list-style: none;
        margin-bottom: 30px
    }

    .check li {
        margin-bottom: 15px
    }

    .check li i {
        color: #659f48;
        margin-right: 10px
    }

    .force {
        display: table;
        margin: 0 auto
    }

    .counter ul {
        list-style: none;
        width: 100%;
        padding: 0;
        margin-bottom: 20px
    }

    .counter ul li {
        display: inline;
        color: #000;
        font-size: 82px;
        float: left;
        margin-left: 10px;
        padding: 40px 15px;
        border-radius: 4px;
        background: #eee;
        display: inline-block;
        font-weight: 700;
        border: 2px solid #ddd;
        background: rgba(242, 242, 242, 1);
        background: -moz-linear-gradient(top, rgba(242, 242, 242, 1) 0%, rgba(227, 227, 227, 1) 50%, rgba(255, 255, 255, 1) 51%, rgba(242, 242, 242, 1) 100%);
        background: -webkit-gradient(left top, left bottom, color-stop(0%, rgba(242, 242, 242, 1)), color-stop(50%, rgba(227, 227, 227, 1)), color-stop(51%, rgba(255, 255, 255, 1)), color-stop(100%, rgba(242, 242, 242, 1)));
        background: -webkit-linear-gradient(top, rgba(242, 242, 242, 1) 0%, rgba(227, 227, 227, 1) 50%, rgba(255, 255, 255, 1) 51%, rgba(242, 242, 242, 1) 100%);
        background: -o-linear-gradient(top, rgba(242, 242, 242, 1) 0%, rgba(227, 227, 227, 1) 50%, rgba(255, 255, 255, 1) 51%, rgba(242, 242, 242, 1) 100%);
        background: -ms-linear-gradient(top, rgba(242, 242, 242, 1) 0%, rgba(227, 227, 227, 1) 50%, rgba(255, 255, 255, 1) 51%, rgba(242, 242, 242, 1) 100%);
        background: linear-gradient(to bottom, rgba(242, 242, 242, 1) 0%, rgba(227, 227, 227, 1) 50%, rgba(255, 255, 255, 1) 51%, rgba(242, 242, 242, 1) 100%);
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#f2f2f2', endColorstr='#f2f2f2', GradientType=0)
    }

    .customer {
        background: #f2f2f2;
        padding: 40px 0
    }

    .customer img {
        margin-bottom: 20px
    }

    .how-it-works {
        padding: 40px 0
    }

    .install, .customise, .grow {
        margin-bottom: 20px
    }

    .steps {
        padding-top: 20px
    }

    .steps img {
        margin-bottom: 15px
    }

    .support {
        padding: 60px 0
    }

    .support a:hover img {
        cursor: pointer
    }

    .install a:hover img, .customise a:hover img, .grow a:hover img {
        cursor: pointer
    }

    .features {
        background: #fff9da;
        padding: 40px 0
    }

    hr {
        border-color: rgba(0, 0, 0, 0.2)
    }

    .features img {
        margin-bottom: 15px
    }

    .trusted {
        padding: 40px 0
    }

    .trusted img:first-child {
        margin-bottom: 40px
    }

    .pricing {
        padding: 40px 0
    }

    .table {
        margin-bottom: 40px
    }

    tbody tr:nth-child(odd) {
        background: #f2f2f2
    }

    tbody a:hover {
        text-decoration: none;
        cursor: pointer
    }

    tbody data-content {
        text-transform: lowercase
    }

    thead {
        border: none;
        -webkit-border-top-left-radius: 4px;
        -webkit-border-top-right-radius: 4px;
        -moz-border-radius-topleft: 4px;
        -moz-border-radius-topright: 4px;
        border-top-left-radius: 4px;
        border-top-right-radius: 4px
    }

    thead th:first-child {
        background: transparent
    }

    thead th {
        background: #4b6eb2;
        color: rgba(255, 255, 255, 0.7);
        font-weight: 400
    }

    .table > thead > tr > th {
        border-bottom: none
    }

    .table > thead > tr > th > small {
        display: block;
        margin-bottom: 10px
    }

    .table > thead > tr > th > .btn-primary {
        font-size: 13px
    }

    .table > thead > tr > th {
        padding: 30px 0 35px
    }

    .table > thead > tr > th:nth-child(3) {
        background: #41619E
    }

    thead th h2 {
        color: #fff;
        margin: 0;
        padding: 10px 0
    }

    .table > tbody > tr > td {
        padding: 15px;
        border-left: 1px solid #ddd
    }

    .table > tbody > tr {
        border-right: 1px solid #ddd
    }

    .table > tbody > tr > td {
        border-bottom: 1px solid #ddd
    }

    .table > tbody > tr > td:first-child {
        font-size: 13px;
        line-height: 25px
    }

    .table > tbody > tr > td > i.fa {
        color: #659f48;
        font-size: 24px
    }

    .table > tbody > tr > td > i.fa.fa-times-circle {
        color: red;
        font-size: 24px
    }

    .table > tbody > tr > td:first-child > i.fa {
        font-size: 16px;
        line-height: 25px;
        margin-right: 10px;
        color: #444
    }

    .table > tbody > tr:last-child > td:first-child {
        border: none
    }

    .guarantee {
        border-radius: 4px;
        padding: 20px 20px 10px;
        background: rgba(255, 255, 255, 1);
        background: -moz-linear-gradient(top, rgba(255, 255, 255, 1) 0%, rgba(246, 246, 246, 1) 47%, rgba(227, 227, 227, 1) 100%);
        background: -webkit-gradient(left top, left bottom, color-stop(0%, rgba(255, 255, 255, 1)), color-stop(47%, rgba(246, 246, 246, 1)), color-stop(100%, rgba(227, 227, 227, 1)));
        background: -webkit-linear-gradient(top, rgba(255, 255, 255, 1) 0%, rgba(246, 246, 246, 1) 47%, rgba(227, 227, 227, 1) 100%);
        background: -o-linear-gradient(top, rgba(255, 255, 255, 1) 0%, rgba(246, 246, 246, 1) 47%, rgba(227, 227, 227, 1) 100%);
        background: -ms-linear-gradient(top, rgba(255, 255, 255, 1) 0%, rgba(246, 246, 246, 1) 47%, rgba(227, 227, 227, 1) 100%);
        background: linear-gradient(to bottom, rgba(255, 255, 255, 1) 0%, rgba(246, 246, 246, 1) 47%, rgba(227, 227, 227, 1) 100%);
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffff', endColorstr='#e3e3e3', GradientType=0);
        box-shadow: 0 1px 5px rgba(0, 0, 0, .4)
    }

    footer {
        background: #496DAB;
        color: #fff;
        font-size: 14px;
        padding: 20px 0;
        border-top: 5px solid #314c7b
    }

    footer a {
        color: #fff;
        margin-left: 20px
    }

    footer ul {
        width: 100%;
        margin: 0;
        list-style: none;
        padding: 20px 0 0
    }

    footer ul li {
        display: inline
    }

    footer ul li a {
        text-transform: uppercase;
        font-size: 17px;
        color: #fff
    }

    footer a:hover {
        color: #fff;
        text-decoration: none
    }

    footer.copyright {
        background: #41619E;
        padding-top: 20px;
        border: none
    }

    @media only screen and (min-width: 480px) {
        .jumbotron {
            height: 840px
        }
    }

    @media only screen and (min-width: 768px) {
        .jumbotron {
            height: 900px
        }

        .navbar-nav {
            float: right
        }
    }

    @media only screen and (min-width: 992px) {
        .jumbotron {
            height: 950px
        }
    }

    .retro {
        text-shadow: 3px 3px 0px #2c2e38, 5px 5px 0px #5c5f72;
        font: 40px 'BazarMedium';
        letter-spacing: 5px;
    }

    .embossed {
        text-shadow: -1px -1px 1px #fff, 1px 1px 1px #000;
        color: #9c8468;
        opacity: 0.3;
        font: 30px 'Museo700';
    }

    .has-feedback .form-control-feedback {
        position: absolute;
        top: 3px;
        right: 15px;
        display: block;
        width: 34px;
        height: 34px;
        line-height: 34px;
        text-align: center;
    }


</style>


<div class="content-wrapper bg23">

    <section class="content col-md-10 col-sm-12 customCenter">

        <div class="box no-border">

            <div class="box-body dropshadow">
                <div class="row col-md-12">

                    <form id="registration" method="post">
                        <h2>Membership Role</h2>
                        <section data-step="0">

                            <table class="table">
                                <thead>
                                <tr>
                                    <th>&nbsp;</th>
                                    <th class="text-center">
                                        <strong class="retro">Broker</strong> <br>

                                        <h2>
                                            <!--                                            <span class="embossed" style="color: silver">Silver</span> <br/>-->
                                            <!--                                            <span class="embossed" style="color: gold">Gold</span><br/>-->
                                            <!--                                            <span class="embossed" style="color: #E5E4E2">Platinum</span>-->
                                        </h2>
                                        <small>As a Broker you will be able to manage all of your current Clients repair
                                            process and so much more. Add new Prospects & assist your Clients and Owners
                                            with the purchase/sale of tradelines. We believe that as a broker, you
                                            should be able to assist your clients with unlimited financial information
                                            and tools so they too can achieve GREAT buying power.


                                        </small>
                                    </th>
                                    <th class="text-center">
                                        <strong class="retro">Client</strong>
                                        <br>

                                        <h2>
                                            <!--                                            <span class="embossed" style="color: silver">Silver</span> <br/>-->
                                            <!--                                            <span class="embossed" style="color: gold">Gold</span><br/>-->
                                            <!--                                            <span class="embossed" style="color: #E5E4E2">Platinum</span>-->
                                        </h2>
                                        <small>As a Client you'll be able to actively monitor your personal credit
                                            repair process. Add credit boosting tradelines to your credit. Plus receive
                                            valuable information on repairing and maintaining your financial health with
                                            our monthly tips and pdf books. We have everything  you need to reach your ultimate financial goals such as real estate,funding, and vehicle financing assistance, and aggressive tactics to boost your credit score and remove negative items.
                                            Also direct contact with your referral agent (broker)
                                            and an unlimited access to a broad referral system.
                                        </small>
                                    </th>
                                    <th class="text-center">
                                        <strong class="retro">Owner</strong>
                                        <br>

                                        <h2>
                                            <!--                                            <span class="embossed" style="color: silver">Silver</span> <br/>-->
                                            <!--                                            <span class="embossed" style="color: gold">Gold</span><br/>-->
                                            <!--                                            <span class="embossed" style="color: #E5E4E2">Platinum</span>-->
                                        </h2>
                                        <small>Want to make more income? Do you love helping people achieve their goals and dreams? Well look no more, we have the perfect system and solution for THAT!
                                            As Owner you can add & sell your established tradelines in our marketplace.
                                            Manage Clients on your tradelines & you have direct access to your Broker.
                                        </small>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>

                                <tr class="text-center" id="radio">

                                    <td>&nbsp;</td>
                                    <td>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="roleId" class="membership_role" id="Broker"
                                                       value="5" onclick="$('#registration').steps('next')"/>Broker
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="roleId" class="membership_role" id="Client"
                                                       value="2" onclick="$('#registration').steps('next')"/>Client
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="roleId" class="membership_role" id="Owner"
                                                       value="3" onclick="$('#registration').steps('next')"/>Tradeline
                                                Owner
                                            </label>
                                        </div>
                                    </td>

                                </tr>


                                </tbody>
                            </table>
                        </section>
                        <h2>Membership Type</h2>
                        <section data-step="1">
                            <table class="table membertype" id="membership5">
                                <thead>
                                <tr>
                                    <th style="color: green">Broker Memebership</th>
                                    <?php foreach ($brokerMembership as $val) { ?>
                                        <th class="text-center">
                                            <?php echo $val->value ?><br>

                                            <h2><?php echo '$' . number_format($val->price, 0) ?></h2>

                                        </th>
                                    <?php } ?>

                                </tr>
                                </thead>
                                <tbody>
                                <tr class="text-center">
                                    <td class="text-left">
                                        <i class="fa fa-globe"></i>
                                        <a class="pdpopover" data-toggle="popover"
                                           title="Input and upload your personal information"
                                           data-content="This tells you how many websites you can install PopUp Domination on.">MANAGE
                                            PROFILE</a>
                                    </td>
                                    <td><i id="1" class="fa  fa fa-check-circle"></i></td>
                                    <td><i id="1" class="fa  fa fa-check-circle"></i></td>
                                    <td><i id="1" class="fa  fa fa-check-circle"></i></td>
                                </tr>
                                <tr class="text-center">
                                    <td class="text-left">
                                        <i class="fa fa-check-square"></i>
                                        <a class="pdpopover" data-toggle="popover" title="Broker/Owner manage clientele"
                                           data-content="We do not limit how many PopUps you can create.">MANAGE
                                            CLIENTS</a>
                                    </td>
                                    <td><i id="2" class="fa  fa fa-check-circle"></i></td>
                                    <td><i id="2" class="fa  fa fa-check-circle"></i></td>
                                    <td><i id="2" class="fa  fa fa-check-circle"></i></td>
                                </tr>
                                <tr class="text-center">
                                    <td class="text-left">
                                        <i class="fa fa-adjust"></i>
                                        <a class="pdpopover" data-toggle="popover"
                                           title="Broker/Owner keep your clients up to date"
                                           data-content="Test different PopUps against each other to determine which converts the best for you!">NEWSLETTERS</a>
                                    </td>
                                    <td><i id="5" class="fa  fa fa-check-circle"></i></td>
                                    <td><i id="5" class="fa  fa fa-check-circle"></i></td>
                                    <td><i id="5" class="fa  fa fa-check-circle"></i></td>
                                </tr>
                                <tr class="text-center">
                                    <td class="text-left">
                                        <i class="fa fa-area-chart"></i>
                                        <a class="pdpopover" data-toggle="popover"
                                           title="Send and Receive personal messages"
                                           data-content="See how well your PopUps are performing.">INBOX</a>
                                    </td>
                                    <td><i id="6" class="fa  fa fa-check-circle"></i></td>
                                    <td><i id="6" class="fa  fa fa-check-circle"></i></td>
                                    <td><i id="6" class="fa  fa fa-check-circle"></i></td>
                                </tr>
                                <tr class="text-center">
                                    <td class="text-left">
                                        <i class="fa fa-wordpress"></i>
                                        <a class="pdpopover" data-toggle="popover"
                                           title="Quick access to all of your available features"
                                           data-content="Each purchase comes with a Wordpress Plugin version to make it super easy to use.">DASHBOARD</a>
                                    </td>
                                    <td><i id="7" class="fa  fa fa-check-circle"></i></td>
                                    <td><i id="7" class="fa  fa fa-check-circle"></i></td>
                                    <td><i id="7" class="fa  fa fa-check-circle"></i></td>
                                </tr>
                                <tr class="text-center">
                                    <td class="text-left">
                                        <i class="fa fa-hdd-o"></i>
                                        <a class="pdpopover" data-toggle="popover" title="Prospects"
                                           data-content="Alone Software: Don?t have a Wordpress site? Use this version to use on any self hosted website.">PROSPECTS</a>
                                    </td>
                                    <td><i id="10" class="fa  fa-times-circle"></i></td>
                                    <td><i id="10" class="fa  fa fa-check-circle"></i></td>
                                    <td><i id="10" class="fa  fa fa-check-circle"></i></td>
                                </tr>

                                <tr class="text-center">
                                    <td class="text-left">
                                        <i class="fa fa-hdd-o"></i>
                                        <a class="pdpopover" data-toggle="popover" title="Financial Tools"
                                           data-content="Alone Software: Don?t have a Wordpress site? Use this version to use on any self hosted website.">FINANCIAL
                                            TOOLS</a>
                                    </td>
                                    <td><i id="11" class="fa  fa-times-circle"></i></td>
                                    <td><i id="11" class="fa  fa fa-check-circle"></i></td>
                                    <td><i id="11" class="fa  fa fa-check-circle"></i></td>
                                </tr>
                                <tr class="text-center">
                                    <td class="text-left">
                                        <i class="fa fa-star"></i>
                                        <a class="pdpopover" data-toggle="popover"
                                           title="View Broker/Owner tradelines and placement"
                                           data-content="There are currently 36 different designs to choose from. Each one comes with different colour combinations.">MANAGE
                                            TRADELINES</a>
                                    </td>
                                    <td><i id="3" class="fa  fa-times-circle"></i></td>
                                    <td><i id="3" class="fa  fa-times-circle"></i></td>
                                    <td><i id="3" class="fa  fa fa-check-circle"></i></td>
                                </tr>
                                <tr class="text-center">
                                    <td class="text-left">
                                        <i class="fa fa-hdd-o"></i>
                                        <a class="pdpopover" data-toggle="popover" title="MarketPlace"
                                           data-content="Alone Software: Don?t have a Wordpress site? Use this version to use on any self hosted website.">MARKETPLACE</a>
                                    </td>
                                    <td><i id="14" class="fa  fa-times-circle"></i></td>
                                    <td><i id="14" class="fa  fa-times-circle"></i></td>
                                    <td><i id="14" class="fa  fa fa-check-circle"></i></td>
                                </tr>
                                <tr class="text-center">
                                    <td class="text-left">
                                        <i class="fa fa-hdd-o"></i>
                                        <a class="pdpopover" data-toggle="popover" title="PDF Books"
                                           data-content="Alone Software: Don?t have a Wordpress site? Use this version to use on any self hosted website.">PDF
                                            BOOKS</a>
                                    </td>
                                    <td><i id="12" class="fa  fa-times-circle"></i></td>
                                    <td><i id="12" class="fa  fa-times-circle"></i></td>
                                    <td><i id="12" class="fa  fa fa-check-circle"></i></td>
                                </tr>

                                <tr class="text-center">
                                    <td class="text-left">
                                        <i class="fa fa-hdd-o"></i>
                                        <a class="pdpopover" data-toggle="popover" title="Transactions"
                                           data-content="Alone Software: Don?t have a Wordpress site? Use this version to use on any self hosted website.">TRANSACTIONS</a>
                                    </td>
                                    <td><i id="13" class="fa  fa-times-circle"></i></td>
                                    <td><i id="13" class="fa  fa-times-circle"></i></td>
                                    <td><i id="13" class="fa  fa fa-check-circle"></i></td>
                                </tr>

                                <tr class="text-center">
                                    <td class="text-left">
                                        <i class="fa fa-sign-out"></i>
                                        <a class="pdpopover" data-toggle="popover"
                                           title="Overview of your personal credit info"
                                           data-content="This features allows you to show the PopUp when someone is about to leave the webpage. Great for catching people who are about to leave!">MANAGE
                                            CREDIT SCORE</a>
                                    </td>
                                    <td><i id="4" class="fa  fa-times-circle"></i></td>
                                    <td><i id="4" class="fa  fa-times-circle"></i></td>
                                    <td><i id="4" class="fa  fa-times-circle"></i></td>
                                </tr>
                                <tr class="text-center">
                                    <td class="text-left">
                                        <i class="fa fa-hdd-o"></i>
                                        <a class="pdpopover" data-toggle="popover"
                                           title="Learn how to get funding for your ventures"
                                           data-content="Alone Software: Don?t have a Wordpress site? Use this version to use on any self hosted website.">FUNDING</a>
                                    </td>
                                    <td><i id="8" class="fa  fa-times-circle"></i></td>
                                    <td><i id="8" class="fa  fa-times-circle"></i></td>
                                    <td><i id="8" class="fa  fa-times-circle"></i></td>
                                </tr>
                                <tr class="text-center">
                                    <td class="text-left">
                                        <i class="fa fa-hdd-o"></i>
                                        <a class="pdpopover" data-toggle="popover" title="Manage Broker"
                                           data-content="Alone Software: Don?t have a Wordpress site? Use this version to use on any self hosted website.">MANAGE
                                            BROKER</a>
                                    </td>
                                    <td><i id="9" class="fa  fa-times-circle"></i></td>
                                    <td><i id="9" class="fa  fa-times-circle"></i></td>
                                    <td><i id="9" class="fa  fa-times-circle"></i></td>
                                </tr>


                                <tr class="text-center">
                                    <td>&nbsp;</td>
                                    <?php foreach ($brokerMembership as $key => $val) { ?>
                                        <td>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" id="member" name="membershipType"
                                                           class="<?php echo $key ?>broker_list"
                                                           value="<?php echo $val->mtId ?>"/><?php echo $val->value ?>
                                                </label>
                                            </div>
                                        </td>
                                    <?php } ?>

                                </tr>
                                </tbody>
                            </table>
                            <script>

                                <?php foreach ($brokerMembership as $key  => $val) { ?>
                                $(document).ready(function () {
                                    $(".0broker_list").click(function () {
                                        $("#1* , #2* , #5* , #6* , #9*").removeClass(' fa-times-circle').addClass('fa-check-circle');
                                        $("#3* , #4* , #8* ,  #10* , #11* , #12* , #13* , #14*").removeClass('fa-check-circle').addClass(' fa-times-circle');
                                    });

                                    $(".1broker_list").click(function () {
                                        $("#1* ,#2* , #5* , #6* , #7* ,#9* ,#10* , #11*").removeClass(' fa-times-circle').addClass('fa-check-circle');
                                        $("#3* , #4* , #8* , #9* , #12* , #13* , #14*").removeClass('fa-check-circle').addClass(' fa-times-circle');
                                    });

                                    $(".2broker_list").click(function () {
                                        $("#1* ,#2* ,#3*, #5* , #6* , #7* , #9* ,#10* , #11* , #12* , #13* , #14*").removeClass(' fa-times-circle').addClass('fa-check-circle');
                                        $("#4* ,#8*").removeClass('fa-check-circle').addClass(' fa-times-circle');
                                    });

                                });

                                <?php } ?>
                            </script>


                            <table class="table membertype" id="membership2">
                                <thead>
                                <tr>
                                    <th style="color: green">Client Membership</th>
                                    <?php foreach ($clientMembership as $val) { ?>
                                        <th class="text-center">
                                            <?php echo $val->value ?><br>

                                            <h2><?php echo '$' . number_format($val->price, 0) ?></h2>

                                        </th>
                                    <?php } ?>
                                </tr>
                                </thead>
                                <tbody>
                                <tr class="text-center">
                                    <td class="text-left">
                                        <i class="fa fa-globe"></i>
                                        <a class="pdpopover" data-toggle="popover"
                                           title="Input and upload your personal information"
                                           data-content="This tells you how many websites you can install PopUp Domination on.">MANAGE
                                            PROFILE</a>
                                    </td>
                                    <td><i id="21" class="fa fa-check-circle"></i></td>
                                    <td><i id="21" class="fa fa-check-circle"></i></td>
                                    <td><i id="21" class="fa fa-check-circle"></i></td>
                                </tr>
                                <tr class="text-center">
                                    <td class="text-left">
                                        <i class="fa fa-sign-out"></i>
                                        <a class="pdpopover" data-toggle="popover"
                                           title="Overview of your personal credit info"
                                           data-content="This features allows you to show the PopUp when someone is about to leave the webpage. Great for catching people who are about to leave!">MANAGE
                                            CREDIT SCORE</a>
                                    </td>
                                    <td><i id="24" class="fa fa-check-circle"></i></td>
                                    <td><i id="24" class="fa fa-check-circle"></i></td>
                                    <td><i id="24" class="fa fa-check-circle"></i></td>
                                </tr>
                                <tr class="text-center">
                                    <td class="text-left">
                                        <i class="fa fa-area-chart"></i>
                                        <a class="pdpopover" data-toggle="popover"
                                           title="Send and Receive personal messages"
                                           data-content="See how well your PopUps are performing.">INBOX</a>
                                    </td>
                                    <td><i id="26" class="fa fa-check-circle"></i></td>
                                    <td><i id="26" class="fa fa-check-circle"></i></td>
                                    <td><i id="26" class="fa fa-check-circle"></i></td>
                                </tr>
                                <tr class="text-center">
                                    <td class="text-left">
                                        <i class="fa fa-wordpress"></i>
                                        <a class="pdpopover" data-toggle="popover"
                                           title="Quick access to all of your available features"
                                           data-content="Each purchase comes with a Wordpress Plugin version to make it super easy to use.">DASHBOARD</a>
                                    </td>
                                    <td><i id="27" class="fa fa-check-circle"></i></td>
                                    <td><i id="27" class="fa fa-check-circle"></i></td>
                                    <td><i id="27" class="fa fa-check-circle"></i></td>
                                </tr>
                                <tr class="text-center">
                                    <td class="text-left">
                                        <i class="fa fa-support"></i>
                                        <a class="pdpopover" data-toggle="popover" title="Shop Tradelines"
                                           data-content="Get a year of email support, plus lifetime updates.">MARKETPLACE</a>
                                    </td>
                                    <td><i id="29" class="fa fa-check-circle"></i></td>
                                    <td><i id="29" class="fa fa-check-circle"></i></td>
                                    <td><i id="29" class="fa fa-check-circle"></i></td>
                                </tr>
                                <tr class="text-center">
                                    <td class="text-left">
                                        <i class="fa fa-support"></i>
                                        <a class="pdpopover" data-toggle="popover" title="Business Credit"
                                           data-content="Get a year of email support, plus lifetime updates.">REAL
                                            ESTATE</a>
                                    </td>
                                    <td><i id="35" class="fa  fa-times-circle"></i></td>
                                    <td><i id="35" class="fa fa-check-circle"></i></td>
                                    <td><i id="35" class="fa fa-check-circle"></i></td>
                                </tr>
                                <tr class="text-center">
                                    <td class="text-left">
                                        <i class="fa fa-support"></i>
                                        <a class="pdpopover" data-toggle="popover" title="Business Credit"
                                           data-content="Get a year of email support, plus lifetime updates.">VEHICLLE
                                            FINANCING</a>
                                    </td>
                                    <td><i id="35" class="fa  fa-times-circle"></i></td>
                                    <td><i id="35" class="fa fa-check-circle"></i></td>
                                    <td><i id="35" class="fa fa-check-circle"></i></td>
                                </tr>
                                <tr class="text-center">
                                    <td class="text-left">
                                        <i class="fa fa-hdd-o"></i>
                                        <a class="pdpopover" data-toggle="popover"
                                           title="Learn how to get funding for your ventures"
                                           data-content="Alone Software: Don�t have a Wordpress site? Use this version to use on any self hosted website.">FUNDING</a>
                                    </td>
                                    <td><i id="28" class="fa  fa-times-circle"></i></td>
                                    <td><i id="28" class="fa  fa-times-circle"></i></td>
                                    <td><i id="28" class="fa fa-check-circle"></i></td>
                                </tr>
                                <tr class="text-center">
                                    <td class="text-left">
                                        <i class="fa fa-support"></i>
                                        <a class="pdpopover" data-toggle="popover" title="Monthly Tips"
                                           data-content="Get a year of email support, plus lifetime updates.">MONTHLY
                                            TIPS</a>
                                    </td>
                                    <td><i id="33" class="fa  fa-times-circle"></i></td>
                                    <td><i id="33" class="fa  fa-times-circle"></i></td>
                                    <td><i id="33" class="fa fa-check-circle"></i></td>
                                </tr>
                                <tr class="text-center">
                                    <td class="text-left">
                                        <i class="fa fa-support"></i>
                                        <a class="pdpopover" data-toggle="popover" title="PDF Books"
                                           data-content="Get a year of email support, plus lifetime updates.">PDF
                                            BOOKS</a>
                                    </td>
                                    <td><i id="34" class="fa  fa-times-circle"></i></td>
                                    <td><i id="34" class="fa  fa-times-circle"></i></td>
                                    <td><i id="34" class="fa fa-check-circle"></i></td>
                                </tr>
                                <tr class="text-center">
                                    <td class="text-left">
                                        <i class="fa fa-support"></i>
                                        <a class="pdpopover" data-toggle="popover" title="Business Credit"
                                           data-content="Get a year of email support, plus lifetime updates.">BUSINESS
                                            CREDIT</a>
                                    </td>
                                    <td><i id="35" class="fa  fa-times-circle"></i></td>
                                    <td><i id="35" class="fa  fa-times-circle"></i></td>
                                    <td><i id="35" class="fa fa-check-circle"></i></td>
                                </tr>

                                <tr class="text-center">
                                    <td>&nbsp;</td>
                                    <?php foreach ($clientMembership as $key => $val) { ?>
                                        <td>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" id="member" name="membershipType"
                                                           class="<?php echo $key ?>client_list"
                                                           value="<?php echo $val->mtId ?>"" /><?php echo $val->value ?>
                                                </label>
                                            </div>
                                        </td>
                                    <?php } ?>
                                </tr>
                                </tbody>
                            </table>

                            <script>

                                <?php foreach ($clientMembership as $key  => $val) { ?>
                                $(document).ready(function () {
                                    $(".0client_list").click(function () {
                                        $("#21* ,#24* , #26* , #27* , #29*").removeClass(' fa-times-circle').addClass('fa-check-circle');
                                        $("#22* , #23* , #25* ,  #28* , #30* , #31* , #32* , #33* , #34* , #35*").removeClass('fa-check-circle').addClass(' fa-times-circle');
                                    });

                                    $(".1client_list").click(function () {
                                        $("#21* ,#24* , #26* , #27* , #29*  , #30* , #31*").removeClass(' fa-times-circle').addClass('fa-check-circle');
                                        $("#22* , #23* , #25* ,  #28* , #32* , #33* , #34* , #35*").removeClass('fa-check-circle').addClass(' fa-times-circle');
                                    });

                                    $(".2client_list").click(function () {
                                        $("#21* , #24* , #26* ,  #27* , #29* , #30* , #31* , #32* , #33* , #34* , #35*").removeClass(' fa-times-circle').addClass('fa-check-circle');
                                        $("#22* , #23* , #25* ,  #28*").removeClass('fa-check-circle').addClass(' fa-times-circle');

                                    });

                                });

                                <?php } ?>
                            </script>


                            <table class="table membertype" id="membership3">
                                <thead>
                                <tr>
                                    <th style="color: green">Owner Membership</th>
                                    <?php foreach ($ownerMembership as $val) { ?>
                                        <th class="text-center">
                                            <?php echo $val->value ?><br>

                                            <h2><?php echo '$' . number_format($val->price, 0) ?></h2>
                                        </th>
                                    <?php } ?>
                                </tr>
                                </thead>
                                <tbody>
                                <tr class="text-center">
                                    <td class="text-left">
                                        <i class="fa fa-globe"></i>
                                        <a class="pdpopover" data-toggle="popover"
                                           title="Input and upload your personal information"
                                           data-content="This tells you how many websites you can install PopUp Domination on.">MANAGE
                                            PROFILE</a>
                                    </td>
                                    <td><i class="fa fa-check-circle"></i></td>
                                    <td><i class="fa fa-check-circle"></i></td>
                                    <td><i class="fa fa-check-circle"></i></td>
                                </tr>
                                <tr class="text-center">
                                    <td class="text-left">
                                        <i class="fa fa-star"></i>
                                        <a class="pdpopover" data-toggle="popover"
                                           title="View Broker/Owner tradelines and placement"
                                           data-content="There are currently 36 different designs to choose from. Each one comes with different colour combinations.">MANAGE
                                            TRADELINES</a>
                                    </td>
                                    <td><i class="fa fa-check-circle"></i></td>
                                    <td><i class="fa fa-check-circle"></i></td>
                                    <td><i class="fa fa-check-circle"></i></td>
                                </tr>
                                <tr class="text-center">
                                    <td class="text-left">
                                        <i class="fa fa-area-chart"></i>
                                        <a class="pdpopover" data-toggle="popover"
                                           title="Send and Receive personal messages"
                                           data-content="See how well your PopUps are performing.">INBOX</a>
                                    </td>
                                    <td><i class="fa fa-check-circle"></i></td>
                                    <td><i class="fa fa-check-circle"></i></td>
                                    <td><i class="fa fa-check-circle"></i></td>
                                </tr>
                                <tr class="text-center">
                                    <td class="text-left">
                                        <i class="fa fa-wordpress"></i>
                                        <a class="pdpopover" data-toggle="popover"
                                           title="Quick access to all of your available features"
                                           data-content="Each purchase comes with a Wordpress Plugin version to make it super easy to use.">DASHBOARD</a>
                                    </td>
                                    <td><i class="fa fa-check-circle"></i></td>
                                    <td><i class="fa fa-check-circle"></i></td>
                                    <td><i class="fa fa-check-circle"></i></td>
                                </tr>
                                <tr class="text-center">
                                    <td>&nbsp;</td>
                                    <?php foreach ($ownerMembership as $val) { ?>
                                        <td>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" id="member" name="membershipType"
                                                           value="<?php echo $val->mtId ?>"" /><?php echo $val->value ?>
                                                </label>
                                            </div>
                                        </td>
                                    <?php } ?>
                                </tr>
                                </tbody>
                            </table>
                            <div class="form-group col-md-6">
                                <label for="coupon">Coupon:</label>

                                <div class="input-group">

                                    <?php if (!empty($coupon)) { ?>
                                        <div class="input-group-addon"><i class="fa fa-tags"></i></div>
                                        <input type='text' class="form-control" id='coupon'
                                               name="coupon"
                                               value="<?php echo $coupon ?>" disabled/>
                                        <input type="hidden" name="coupon" value="<?php echo $coupon ?>">
                                    <?php } else { ?>
                                        <div class="input-group-addon"><i class="fa fa-tags"></i></div>
                                        <input type='text' class="form-control" id='coupon'
                                               name="coupon" value=""/>
                                    <?php } ?>
                                </div>
                            </div>
                        </section>
                        <h2>Login Details</h2>
                        <section data-step="2">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="email">Username:</label>

                                    <div class="input-group">
                                        <div class="input-group-addon"><strong>@</strong></div>

                                        <?php if (!empty($user)) { ?>
                                            <input type='text' class="form-control" id='email' name="email"
                                                   value="<?php echo $user->email ?>" disabled/>
                                            <input type="hidden" name="email" value="<?php echo $user->email ?>">
                                        <?php } else { ?>
                                            <input type='text' class="form-control" id='email' name="email"
                                                   placeholder="Enter Your Email Address" value=""/>
                                        <?php } ?>

                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="password">Password:</label>

                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-key"> </i></div>
                                        <input type='password' class="form-control" id='password'
                                               placeholder="Password"
                                               name="password"
                                               value=""/>

                                    </div>
                                </div>
                                <div class="form-group col-md-6" style="padding-left: 20px;">
                                    <label for="rePassword">Confirm Password:</label>

                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-key"> </i></div>
                                        <input type='password' class="form-control" id='rePassword'
                                               placeholder="Enter Your Password Again"
                                               name="rePassword"
                                               value=""/>

                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="Question1">Security Question 1:</label>

                                    <div class="input-group">
                                        <?php
                                        $options1 = array();
                                        foreach ($questions as $key => $question) {
                                            if ($key <= 9) {
                                                $options1[$question->id] = $question->question;
                                            }
                                        }
                                        echo form_dropdown('question1', array('' => 'Please select your 1st security question') + $options1, '', array('id' => 'question1', 'class' => 'form-control ')); ?>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="Answer1">Answer:</label>

                                    <div class="input-group">
                                        <div class="input-group-addon"><strong>A</strong></i></div>
                                        <input type="password" class="form-control" id="answer1" name="answer1">
                                    </div>

                                </div>

                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="Question2">Security Question 2:</label>

                                    <div class="input-group">
                                        <?php
                                        $options2 = array();
                                        foreach ($questions as $key => $question) {
                                            if ($key > 9) {
                                                $options2[$question->id] = $question->question;
                                            }
                                        }
                                        echo form_dropdown('question2', array('' => 'Please select your 2nd security question') + $options2, '', array('id' => 'question2', 'class' => 'form-control ')); ?>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="Answer2">Answer:</label>

                                    <div class="input-group">
                                        <div class="input-group-addon"><strong>A</strong></div>
                                        <input class="form-control" id="answer2" name="answer2" type="password">
                                    </div>
                                </div>


                            </div>


                            <div class="row" id="payment_method">
                                <div class="form-group col-md-12">
                                    <label for="paymentType">Payment Method:</label>

                                    <div class="input-group">
                                        <input type="radio" name="paymentType" id="paypal" value="paypal"/> Paypal /
                                        Credit Card

                                        <input type="radio" name="paymentType" id="check" value="check"/> Others
                                        <!--                                        <input type="radio" name="paymentType" id="cash" value="cash"/> Cash-->
                                        <!--                                        <input type="radio" name="paymentType" id="creditCard" value="creditCard"/>-->
                                        <!--                                        Credit Card-->
                                    </div>
                                    <div class="recurring-part"><input type="checkbox" name="recurring" id="recurring"
                                                                       value="1"/> Recurring Paypal
                                    </div>
                                </div>
                                <div class="form-group col-md-12 paymentNote" style="display: none;">
                                    Please call this number (222)-222-2222 for further payment Process
                                </div>
                            </div>

                        </section>
                        <h2>Member Details</h2>
                        <section data-step="3">

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="site">Broker:</label>

                                    <div class="input-group">
                                        <?php echo form_dropdown('brokerId', array('' => 'Choose your broker') + $brokers, $brokerId ? $brokerId : '', array('class' => 'form-control', 'data-width' => '370px', 'id' => 'brokerId', 'name' => 'brokerId[]', $brokerId ? 'readonly' : 'enabled' => $brokerId ? 'readonly' : 'enabled')); ?>
                                    </div>
                                </div>
                                <div class="form-group col-md-6 website">
                                    <label for="site">Website:</label>

                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-globe"></i></div>
                                        <input type='text' class="form-control" id='site' name="site""/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="form-group col-md-6 ssn">
                                    <label for="ssn">SSN:</label>

                                    <div class="input-group ">
                                        <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                        <input type="text" class="form-control" id="ssn" name="ssn"
                                               data-mask="000-00-0000"
                                               placeholder="___-__-____"/>
                                    </div>
                                </div>

                                <div class="form-group col-md-6 dob">
                                    <label for="dob">Date Of Birth:</label>

                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                        <input type='text' class="form-control" id='dob' name="dob"

                                               placeholder="MM/DD/YYYY" "/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="firstName">First Name:</label>

                                    <div class="input-group">
                                        <div class="input-group-addon"><strong>F</strong></i></div>
                                        <input type='text' class="form-control" id='firstName'
                                               name="firstName"
                                               value="<?php echo $user->first_name ?>"/>

                                    </div>
                                </div>

                                <div class="form-group col-md-2">
                                    <label for="firstName">MI:</label>

                                    <div class="input-group">
                                        <div class="input-group-addon"><strong>M</strong></i></div>
                                        <input type='text' class="form-control" id='mi'
                                               name="mi"
                                               value="<?php echo $user->middle_initial ?>"/>

                                    </div>


                                </div>

                                <div class="form-group col-md-6">
                                    <label for="lastName">Last Name:</label>

                                    <div class="input-group">
                                        <div class="input-group-addon"><strong>L</strong></i></div>
                                        <input type='text' class="form-control" id='email' name="lastName"
                                               value="<?php echo $user->last_name ?>"/>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="phone">Phone number:</label>

                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                                        <input type="text" class="form-control"
                                               id="phone" name="phone"
                                               data-mask="(999)-999-9999" placeholder="(999)-999-9999"/>
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="fax">Fax number:</label>

                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-fax"></i></div>
                                        <input type="text" class="form-control" data-mask="000-00-0000"
                                               placeholder="(999)-999-9999"
                                               id="fax" name="fax"/>
                                    </div>
                                </div>
                            </div>

                            <div class="row">


                                <!---->
                                <!--                                <div class="form-group col-md-6">-->
                                <!--                                    <div class="g-recaptcha" id="g-recaptcha-response"-->
                                <!--                                         data-sitekey="6LfbIw4TAAAAAIQ7rKsikRoBiKqbtmrtvkPBooe5"></div>-->
                                <!--                                    <span id="captcha" style="color:red"/>-->
                                <!--                                </div>-->

                            </div>
                        </section>
                    </form>
                </div>
            </div>
        </div>
    </section>

</div>

<div class="modal fade" id="welcomeModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Welcome</h4>
            </div>
            <div class="modal-body">
                <p class="text-center">Thanks for signing up</p>
            </div>
        </div>
    </div>
</div>

<!--<script src="https://www.google.com/recaptcha/api.js"></script>-->

<!--<script>-->
<!--    $("#butoonID").click(function () {-->
<!--        if ($("#g-recaptcha-response").val()) {-->
<!--            $.ajax({-->
<!--                type: 'POST',-->
<!--                url: "--><?php //echo base_url('register/verifyRecaptcha') ?><!--",-->
<!--                dataType: 'html',-->
<!--                async: true,-->
<!--                data: {-->
<!--                    captchaResponse: $("#g-recaptcha-response").val()-->
<!--                },-->
<!--                success: function (data) {-->
<!--                    console.log("everything looks ok");-->
<!--                },-->
<!--                error: function (XMLHttpRequest, textStatus, errorThrown) {-->
<!--                    console.log("You're a bot");-->
<!--                }-->
<!--            });-->
<!--        } else {-->
<!--            document.getElementById('captcha').innerHTML = "Captcha field is required";-->
<!--        }-->
<!--    });-->
<!--</script>-->


<script>


    $(document).ready(function () {

        function adjustIframeHeight() {
            var $body = $('body'),
                $iframe = $body.data('iframe.fv');
            if ($iframe) {
                $iframe.height($body.height());
            }
            $('html, body').animate({scrollTop: 0}, 'slow');
        }


        $('#registration')
            .steps({
                headerTag: 'h2',
                bodyTag: 'section',
                onStepChanged: function (e, currentIndex, priorIndex) {
                    adjustIframeHeight();
                },
                onStepChanging: function (e, currentIndex, newIndex) {
                    if (currentIndex > newIndex) {
                        return true;
                    }
                    if (currentIndex === 1) {
                        var fv = $('#registration').data('formValidation'),
                            $container = $('#registration').find('section[data-step="' + currentIndex + '"]');
                        fv.validateContainer($container);
                        var isValidStep = fv.isValidContainer($container);

                        e.preventDefault();
                        async: false;
                        $.post("<?php echo base_url() . 'register/checkCouponRole'; ?>", $(this).serialize() + '&' + $.param({
                                'roleId': $("input:radio[name=roleId]:checked").val()
                            }))
                            .done(function (data) {
                                var response = $.parseJSON(data);
                                //  $("#payment_method").toggle(response);
                                serverValidationNoRedirect($("#registration"), data);
                                if (response.coupon == 'Empty') {
                                    isValidStep = true;
                                }
                                else if (response.result == 'error') {
                                    isValidStep = false;
                                    return false;
                                }
                            });
                        if (isValidStep === false || isValidStep === null) {
                            return false;
                        }
                        return true;

                    }
                    else if (newIndex == 3) {
                        var fv = $('#registration').data('formValidation'), // FormValidation instance
                            $container = $('#registration').find('section[data-step="' + currentIndex + '"]');
                        fv.validateContainer($container);
                        var isValidStep = fv.isValidContainer($container);
                        if (isValidStep === false || isValidStep === null) {
                            return false;
                        }
                        e.preventDefault();
                        async:false;
                        $.post("<?php echo base_url() . 'register/checkMembership'; ?>", $(this).serialize() + '&' + $.param({
                                'roleId': $("input:radio[name=roleId]:checked").val(),
                                'membershipType': $("input:radio[name=membershipType]:checked").val(),
                                'paymentType': $("input:radio[name=paymentType]:checked").val(),
                                'coupon': $("#coupon").val()
                            }))
                            .done(function (data) {
                                var response = $.parseJSON(data);
                              
                                if (response.paymentType == 'paypal') {

                                    if ($("#recurring").is(":checked")) { // paypal recurring payment

                                        serverValidationNew($("#registration"), data, '<?php echo base_url() . 'member/registrationPay/'?>' + response.userId + '/' + response.campaign + '/' + response.membershipTypeId + '/recurring');

                                    } else {

                                        serverValidationNew($("#registration"), data, '<?php echo base_url() . 'member/registrationPay/'?>' + response.userId + '/' + response.campaign + '/' + response.membershipTypeId);

                                    }

                                } else {
                                    serverValidationNew($("#registration"), data, '<?php echo base_url() . 'member/registrationPayOthers/'?>' + response.userId + '/' + response.role + '/' + response.campaign + '/' + response.membershipTypeId + '/' + response.paymentType);
                                }
                            });
                        return true;
                    }
                    else {
                        var fv = $('#registration').data('formValidation'), // FormValidation instance
                            $container = $('#registration').find('section[data-step="' + currentIndex + '"]');
                        fv.validateContainer($container);
                        var isValidStep = fv.isValidContainer($container);
                        if (isValidStep === false || isValidStep === null) {
                            return false;
                        }
                        return true;
                    }


                },
                onFinishing: function (e, currentIndex) {
                    var fv = $('#registration').data('formValidation'),
                        $container = $('#registration').find('section[data-step="' + currentIndex + '"]');
                    fv.validateContainer($container);
                    var isValidStep = fv.isValidContainer($container);
                    if (isValidStep === false || isValidStep === null) {
                        return false;
                    }
                    return true;
                },
                onFinished: function (e, currentIndex) {
                    e.preventDefault();
                    $.post("<?php echo base_url() . 'register/addUser'; ?>", $(this).serialize())
                        .fail(function () {
                            return true;
                        }).done(function (data) {
                            var response = $.parseJSON(data);

                            if (response.paymentType == 'paypal') {

                                if ($("#recurring").is(":checked")) { // paypal recurring payment

                                    serverValidationNew($("#registration"), data, '<?php echo base_url() . 'member/registrationPay/'?>' + response.userId + '/' + response.campaign + '/' + response.membershipTypeId + '/recurring');

                                } else {

                                    serverValidationNew($("#registration"), data, '<?php echo base_url() . 'member/registrationPay/'?>' + response.userId + '/' + response.campaign + '/' + response.membershipTypeId);

                                }
                            }
                            else {
                                serverValidationNew($("#registration"), data, '<?php echo base_url() . 'member/registrationPayOthers/'?>' + response.userId + '/' + response.role + '/' + response.campaign + '/' + response.membershipTypeId + '/' + response.paymentType);
                            }
                        });
                }
            }).on('init.field.fv', function (e, data) {
                var $icon = data.element.data('fv.icon'),
                    options = data.fv.getOptions(),
                    validators = data.fv.getOptions(data.field).validators;
                if (validators.notEmpty && options.icon && options.icon.required) {
                    $icon.addClass(options.icon.required).show();
                }
            })
            .formValidation({
                framework: 'bootstrap',
                icon: {
                    required: 'fa fa-asterisk',
                    valid: 'fa fa-check',
                    invalid: 'fa fa-times',
                    validating: 'fa fa-refresh'
                },
                excluded: ':disabled',
                fields: {
                    username: {
                        validators: {
                            notEmpty: {
                                message: 'Required'
                            },
                            stringLength: {
                                min: 6,
                                max: 30,
                                message: 'The username must be more than 6 and less than 30 characters long'
                            },
                            regexp: {
                                regexp: /^[a-zA-Z0-9_\.]+$/,
                                message: 'The username can only consist of alphabetical, number, dot and underscore'
                            }
                        }
                    }, 'roleId': {
                        validators: {
                            notEmpty: {
                                message: 'Required'
                            }
                        }
                    }, membershipType: {
                        validators: {
                            notEmpty: {
                                message: 'Required'
                            }
                        }
                    }, paymentType: {
                        validators: {
                            notEmpty: {
                                message: 'Required'
                            }
                        }
                    },
                    email: {
                        validators: {
                            notEmpty: {
                                message: 'Required'
                            },
                            regexp: {
                                regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
                                message: 'The value is not a valid email address'
                            }, blank: {}
                        }
                    },
                    password: {
                        validators: {
                            notEmpty: {
                                message: 'Required'
                            },
                            securePassword: {
                                message: 'The password is not valid'
                            }
                        }
                    }, rePassword: {
                        validators: {
                            notEmpty: {
                                message: 'Required'
                            },
                            identical: {
                                field: 'password',
                                message: 'The confirm password must be the same as original one'
                            }
                        }
                    },
                    brokerId: {
                        validators: {
                            notEmpty: {
                                message: 'Required'
                            },
                            blank: {}
                        }
                    }, firstName: {
                        validators: {
                            notEmpty: {
                                message: 'Required'
                            },
                            regexp: {
                                regexp: /^[a-z\s]+$/i,
                                message: 'The first name can consist of alphabetical characters and spaces only'
                            },
                            blank: {}
                        }
                    }, lastName: {
                        validators: {
                            notEmpty: {
                                message: 'Required'
                            },
                            regexp: {
                                regexp: /^[a-z\s]+$/i,
                                message: 'The last name can consist of alphabetical characters and spaces only'
                            },
                            blank: {}
                        }
                    }, mi: {
                        validators: {
                            stringLength: {
                                min: 1,
                                max: 1,
                                message: 'Invalid Length'
                            },
                            regexp: {
                                regexp: /^[a-z\s]+$/i,
                                message: 'The middle initial can consist of alphabetical characters and spaces only'
                            },
                            blank: {}
                        }
                    }, phone: {
                        validators: {
                            notEmpty: {
                                message: 'Required'
                            },
                            blank: {}
                        }
                    }, ssn: {
                        validators: {
                            notEmpty: {
                                message: 'Required'
                            },
                            regexp: {
                                regexp: /^\d{3}-?\d{2}-?\d{4}$/,
                                message: 'SSN format (222-22-2222)'
                            },
                            stringLength: {
                                max: 30
                            },
                            blank: {}
                        }
                    }, dob: {
                        validators: {
                            notEmpty: {
                                message: 'Required'
                            },
                            blank: {},
                            date: {
                                format: 'MM/DD/YYYY',
                                max: '01/01/1994',
                                message: 'You should be at 21 yrs'
                            }
                        }
                    }, question1: {
                        validators: {
                            notEmpty: {
                                message: 'Required'
                            },
                            blank: {}
                        }
                    }, question2: {
                        validators: {
                            notEmpty: {
                                message: 'Required'
                            },
                            blank: {}
                        }
                    }, answer1: {
                        validators: {
                            notEmpty: {
                                message: 'Required'
                            },
                            blank: {}
                        }
                    }, answer2: {
                        validators: {
                            notEmpty: {
                                message: 'Required'
                            },
                            blank: {}
                        }
                    }, membership_level: {
                        validators: {
                            notEmpty: {
                                message: 'Required'
                            },
                            blank: {}
                        }
                    }
                    , coupon: {
                        validators: {
                            optional: true,
                            blank: {}

                        }
                    }
                }
            }).on('err.field.fv', function (e, data) {
                data.element
                    .data('fv.messages')
                    .find('.help-block[data-fv-for="roleId"]').hide();
            }).on('err.field.fv', function (e, data) {
                data.element
                    .data('fv.messages')
                    .find('.help-block[data-fv-for="membershipType"]').hide();
            });
    }).on('status.field.fv', function (e, data) {
        var $icon = data.element.data('fv.icon'),
            options = data.fv.getOptions(),
            validators = data.fv.getOptions(data.field).validators;
        if (validators.notEmpty && options.icon && options.icon.required) {
            $icon.removeClass(options.icon.required).addClass('fa');
        }
    }).on('click', '[name="roleId"]', function () {
        if ($('#Client').is(':checked')) {
            disableValidatorsNew.apply(null, ['#registration', 'phone']);
            $(".membertype").not("#membership" + $("#Client").val()).hide();
            $("#membership" + $("#Client").val()).show();
            $(".ssn,.dob").show();
            $(".website").hide();
        } else if ($('#Broker').is(':checked')) {
            disableValidatorsNew.apply(null, ['#registration', 'ssn', 'dob', 'phone', 'brokerId']);
            $(".membertype").not("#membership" + $("#Broker").val()).hide();
            $("#membership" + $("#Broker").val()).show();
            $(".ssn,.dob").hide();
            $(".website").show();
        } else if ($('#Owner').is(':checked')) {
            disableValidatorsNew.apply(null, ['#registration', 'ssn', 'dob']);
            $(".membertype").not("#membership" + $("#Owner").val()).hide();
            $("#membership" + $("#Owner").val()).show();
            $(".ssn,.dob").hide();
            $(".website").show();
        }
    }).on('click', '[name="paymentType"]', function () {
        if ($('#check, #cash, #creditCard').is(':checked')) {
            $(".paymentNote").show();
        }
        else {
            $(".paymentNote").hide();
        }
    });

    $(document).ready(function () {
        $('#email').focusout(function () {
            $.post("<?php echo base_url() . 'register/checkUserExistByEmail'; ?>", $(this).serialize())
                .done(function (data) {
                    var response = $.parseJSON(data);
                    serverValidationNoRedirect($("#registration"), data);
                });
            return false;

        });
    });

    $(document).ready(function () {
        $('#coupon').keyup(function () {
            $.post("<?php echo base_url() . 'register/checkCouponRole'; ?>", $(this).serialize() + '&' + $.param({
                    'roleId': $("input:radio[name=roleId]:checked").val()
                }))
                .done(function (data) {
                    var response = $.parseJSON(data);
                    if (response == false) {
                        $("#payment_method").hide();
                        $('#registration').formValidation('enableFieldValidators', 'paymentType', false);

                    } else {
                        $("#payment_method").show();
                        $('#registration').formValidation('enableFieldValidators', 'paymentType', true);
                    }
                    serverValidationNoRedirect($("#registration"), data);
                });
            return false;

        });
    });


    $(document).ready(function () {
        $(".recurring-part").hide();
        $('input[name=paymentType]').change(function () {
            if ($('input[name=paymentType][value=paypal]').is(":checked")) {
                $(".recurring-part").show();
                $("#recurring").attr('checked', false);
            } else {
                $(".recurring-part").hide();
                $("#recurring").attr('checked', false);
            }

        });
    });


    $(document).ready(sizing);
    $(window).resize(sizing);


</script>