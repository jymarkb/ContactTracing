@extends('layouts.layout_registration')

@section('title', 'Registration Verification')

@section('import-js')
    <script src="{{ asset('js/citizen/registration.js') }}"></script>
@endsection

@section('content')
    
<section id="eula">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 text-center">
                <h3 class="mt-3">COVID-19 Contact Tracing Libmanan</h3>
                <h5 class="form_sub_title_registration">End-user License Agreement</h5>
            </div>
        </div>

        <div class="row justify-content-center mt-2 mb-5">
            <div class="col-xl-10 col-lg-10 col-md-12 col-sm-12 col-11 form-columns">

                <div class="form-group">
                    <h4 class="text-center">Please read EULA below</h4>
                    <textarea class="form-control text-left" rows="12" id="eluaText">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.

                        The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.

                        It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).

                        There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.
                    </textarea>
                </div>

                <div class="custom-control custom-checkbox mb-4">
                    <input type="checkbox" class="custom-control-input" id="chkAgree" disabled>
                    <label class="custom-control-label" for="chkAgree">I understan the End-user Licence Agreement</label>
                </div>

                <a href="/individual" class="btn btn-primary btn-block next-eula-a hidden">Next</a>
                <button type="button" class="btn btn-primary btn-block next-eula-btn show" disabled>Next</button>
            </div>
        </div>
    </div>

</section>

@endsection