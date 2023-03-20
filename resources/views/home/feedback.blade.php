@extends('layouts.home')
@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm mb-2">
                    <div class="card-header">
                        {{-- <center><img src="{{ asset('img/logo.png') }}" width="65px" alt="" srcset=""></center> --}}
                        <center>Formulir Penyampaian Kritik dan Saran</center>
                        <div id="feedback-form-wrapper">
                            <div id="floating-icon">
                                <button type="button" class="btn btn-primary btn-sm rounded-0" data-toggle="modal"
                                    data-target="#exampleModal">
                                    Feedback
                                </button>

                            </div>
                            <div id="feedback-form-modal">
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Feedback Form</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form>
                                                    <div class="form-group">
                                                        <label for="exampleFormControlTextarea1">How likely you would like
                                                            to recommand us to your friends?</label>
                                                        <div
                                                            class="rating-input-wrapper d-flex justify-content-between mt-2">
                                                            <label><input type="radio" name="rating" /><span
                                                                    class="border rounded px-3 py-2">1</span></label>
                                                            <label><input type="radio" name="rating" /><span
                                                                    class="border rounded px-3 py-2">2</span></label>
                                                            <label><input type="radio" name="rating" /><span
                                                                    class="border rounded px-3 py-2">3</span></label>
                                                            <label><input type="radio" name="rating" /><span
                                                                    class="border rounded px-3 py-2">4</span></label>
                                                            <label><input type="radio" name="rating" /><span
                                                                    class="border rounded px-3 py-2">5</span></label>
                                                            <label><input type="radio" name="rating" /><span
                                                                    class="border rounded px-3 py-2">6</span></label>
                                                            <label><input type="radio" name="rating" /><span
                                                                    class="border rounded px-3 py-2">7</span></label>
                                                            <label><input type="radio" name="rating" /><span
                                                                    class="border rounded px-3 py-2">8</span></label>
                                                            <label><input type="radio" name="rating" /><span
                                                                    class="border rounded px-3 py-2">9</span></label>
                                                            <label><input type="radio" name="rating" /><span
                                                                    class="border rounded px-3 py-2">10</span></label>
                                                        </div>
                                                        <div class="rating-labels d-flex justify-content-between mt-1">
                                                            <label>Very unlikely</label>
                                                            <label>Very likely</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="input-one">What made you leave us so early?</label>
                                                        <input type="text" class="form-control" id="input-one"
                                                            placeholder="">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="input-two">Would you like to say something?</label>
                                                        <textarea class="form-control" id="input-two" rows="3"></textarea>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('partials.footer')
@endsection
