<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

<link rel="preconnect" href="https://fonts.googleapis.com">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;

    font-family:'Helvetica Neue','Poppins',sans-serif;
}

body{
    min-height:100vh;

    display:flex;
    justify-content:center;
    align-items:center;

    overflow:hidden;

    position:relative;

    background:url("../img/download (2).gif") center/cover no-repeat;
}

/* DARK OVERLAY */
body::before{
    content:"";

    position:absolute;
    inset:0;

    background:linear-gradient(
        rgba(0,0,0,0.35),
        rgba(0,0,0,0.55),
        rgba(0,0,0,0.80)
    );

    z-index:0;
}

/* CARD */
.card{
    position:relative;

    width:420px;

    padding:40px!important;

    border:none!important;

    border-radius:28px!important;

    background:rgba(255,255,255,0.08)!important;

    backdrop-filter:blur(20px);

    box-shadow:
    0 10px 40px rgba(0,0,0,0.35),
    0 0 30px rgba(138,92,255,0.12);

    z-index:2;

    overflow:hidden;
}

/* GLOW EFFECT */
.card::before{
    content:"";

    position:absolute;

    width:220px;
    height:220px;

    background:rgba(138,92,255,0.18);

    border-radius:50%;

    top:-120px;
    right:-80px;

    filter:blur(20px);
}

/* TITLE */
.card h2{
    text-align:center;

    color:#fff;

    font-size:28px;
    font-weight:800;

    letter-spacing:3px;

    margin-bottom:8px;
}

/* SUBTEXT */
.auth-subtitle{
    text-align:center;

    color:rgba(255,255,255,0.75);

    font-size:13px;

    margin-bottom:28px;
}

/* LABEL */
label{
    color:#fff;

    font-weight:600;

    margin-bottom:8px;
}

/* INPUT */
.form-control{
    height:52px;

    border:none!important;

    border-radius:14px!important;

    background:rgba(255,255,255,0.10)!important;

    color:#fff!important;

    padding-left:16px;

    margin-bottom:18px;
}

.form-control::placeholder{
    color:rgba(255,255,255,0.55)!important;
}

.form-control:focus{
    background:rgba(255,255,255,0.14)!important;

    box-shadow:
    0 0 0 2px rgba(138,92,255,0.25),
    0 0 18px rgba(138,92,255,0.25)!important;
}

/* BUTTON */
.btn-success{
    height:52px;

    border:none!important;

    border-radius:14px!important;

    background:linear-gradient(
        135deg,
        #6d21d2,
        #8a5cff
    )!important;

    font-size:14px!important;
    font-weight:800!important;

    letter-spacing:2px;

    transition:0.35s;
}

.btn-success:hover{
    transform:translateY(-3px);

    box-shadow:
    0 12px 28px rgba(138,92,255,0.45);
}

/* LINKS */
.auth-link{
    text-align:center;

    margin-top:18px;

    color:rgba(255,255,255,0.75);

    font-size:13px;
}

.auth-link a{
    color:#caa7ff;

    text-decoration:none;

    font-weight:700;

    transition:0.3s;
}

.auth-link a:hover{
    color:#fff;
}

/* ALERT */
.alert-danger{
    border:none!important;

    border-radius:12px!important;

    background:rgba(255,80,80,0.15)!important;

    color:#fff!important;

    font-size:13px;
}

/* MOBILE */
@media(max-width:500px){

    .card{
        width:92%;
        padding:30px!important;
    }

}

</style>