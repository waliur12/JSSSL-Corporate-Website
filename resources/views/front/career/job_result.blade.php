@extends('layouts.frontend.master')
@section('title')
Career
@endsection
@section('pageCss')
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/career.css') }}">
    <style>
        .hero-pt {
    padding-top: 113px;
}
        /*.pdfobject-container { height: 50rem; }*/

        /*ul {list-style: unset!important;}
        
        .error.mt-2.text-danger {
            font-size: 13px;
            font-weight: 500;
        }
        .ajax_loader {
   
      left: 0;
      right: 0;
      top: 0;
      bottom: 0;
      position: fixed;
      background: rgba(255,255,255,0.7);
      width: 100%;
      height: 100% !important;
      z-index: 1050;
      visibility: hidden;
    }
    
    .ajax_loader img {
      top: 50%;
      left: 50%;
      position: absolute;
      color: white;
      transform: translate(-50%, -50%);
    }*/
        </style>
@endsection

@section('content')
   


  
    <section class="career-details hero-pt">
  
        {{-- <div class="container"> --}}
            <div id="job_result_pdf_div"></div>
            
        {{-- </div> --}}



    </section>
@endsection
@section('pageScripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfobject/2.2.6/pdfobject.min.js"
        integrity="sha512-B+t1szGNm59mEke9jCc5nSYZTsNXIadszIDSLj79fEV87QtNGFNrD6L+kjMSmYGBLzapoiR9Okz3JJNNyS2TSg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

   
    <script>
    $('.result').addClass('active');

        var config = {
            routes: {
                downloadAdmitCard: "{!! route('admit.card.download') !!}",
            }
        };
        var options = {
    height: "700px",
    pdfOpenParams: { view: 'FitW'}
};
    
    var pdf_url='{{$pdf_url}}'
    // alert(pdf_url);

        PDFObject.embed(pdf_url, "#job_result_pdf_div",options);


    </script>
@endsection
