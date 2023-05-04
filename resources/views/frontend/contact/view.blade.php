@extends('layouts.app')

@section('title', 'Contact')

@section('content')
    <div class="py-3 py-md-2 bg-light">
        <div class="mt-2 py-3">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-6">
                        <h3>Contact</h3>
                        <h4>For more details please contact us</h4>
                        <hr>
                        <form action="">
                            <div class="row mb-3">
                                <div class="col-6">
                                    <label for="">Full Name</label>
                                    <input class="form-control" type="text">
                                </div>
                                <div class="col-6">
                                    <label for="">Number Phone</label>
                                    <input class="form-control" type="number">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="">Email Address</label>
                                <input type="email" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label for="">Content</label>
                                <textarea name="" id="" cols="30" rows="8" class="form-control"></textarea>
                            </div>

                            <div>
                                <button class="btn btn-primary" type="submit">Send</button>
                            </div>
                        </form>
                    </div>

                    <div class="col-6">
                        <div class="mb-3">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d15715.73357121595!2d105.77034015000001!3d10.0223554!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1svi!2s!4v1666801400891!5m2!1svi!2s"
                                width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                        <div>
                            <div class="mb-5">
                                <h3>Address</h3>
                                <p>Đại học cần thơ Khu 2 quận Ninh Kiều Thành Phố Cần Thơ</p>
                                <p>Email:Nguyenhuyduyvu@gmail.com</p>
                                <p>Website:www.</p>
                            </div>

                            <div>
                                <h6><strong>Open Store</strong></h6>
                                <p>Monday to Saturday: 9:30am - 20:30pm</p>
                                <p>Sunday: 9:30am - 17:30pm</p>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
