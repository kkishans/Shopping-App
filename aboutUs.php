<?php
include './top.php';

    $query = "SELECT 
        ( SELECT count(*) from product_details ) as products,
        ( SELECT count(*) from brands ) as brands,
        ( select count(*) from users ) as users
    ";
      
    $res = mysqli_query($conn,$query);
    $r = mysqli_fetch_assoc($res);

?>

<div class=" mt-5 text-center ">
    <!-- Section Titile -->
    <div class="col-md-12 " data-wow-delay=".2s">
        <h1 class="section-title"> POOJA ELECTRICALS</h1>
    </div>
    <p>The online electronic products shop. Fast delivery, as you deserved.  </p>
</div>
<div class="card-main col-xl-8 m-auto text-center">
    <div class="b-card col-4">
        <div class="b-data">
            <p><?= ($r['brands'] == 1 ) ? "1" : ($r['brands'] - 1) ?>+</p>
        </div>
        <div class="b-title">
            <p>Brands</p>
        </div>
    </div>
    <div class="b-card col-4">
        <div class="b-data">
        <p><?= ($r['products'] == 1 ) ? "1" : ($r['products'] - 1) ?>+</p>
        </div>
        <div class="b-title">
            <p>Products</p>
        </div>
    </div>
    <div class="b-card col-4">
        <div class="b-data">
            <p><?= ($r['users'] == 1 ) ? "1" : ($r['users'] - 1) ?>+</p>
        </div>
        <div class="b-title">
            <p>Clients</p>
        </div>
    </div>  
</div>
<div class="card col-8 m-auto p-4 mt-5 text-center">
    <p>
    <h4>Officially managed by  NEHA SINGH.. </h4><br><b> CON NO-7228010920</b></p>
    <p>ACCOUNTS DEPARTMENT..<br>
        POOJA ELECTRICALS</p>
    <dl>
        <dt>
            <p>shop No-7, J.B.Row House<br>
                Kim char Rasta, Palod-394110<br>
                Near Union Bank, Di-Surat</p>
        </dt>
    </dl>
    <p>GST NO-24AARPU7005J1ZA</p>
</div>
<?php include 'bottom.php' ?>