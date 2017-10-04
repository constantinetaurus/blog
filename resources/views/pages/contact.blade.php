@extends('main')

@section('title', '| Contact')

@section('content')
  <div class="row">
      <div class="col-md-12">
          <h1>Contact Me</h1>
          <hr>
          <form action="{{ url('contact') }}" method="POST"> <!-- we use a url() function instead of a route() function if the route name is not set up in our routes file-->
          {{ csrf_field() }} <!-- always use csrf_field() if you won't use Form::helpers-->
              <div class="form-group">
                  <label name="email">Email:</label>
                  <input class="form-control" name="email" id="email">
              </div>
              <div class="form-group">
                  <label name="subject">Subject:</label>
                  <input class="form-control" name="subject" id="subject">
              </div>
              <div class="form-group">
                  <label name="message">Message:</label>
                  <textarea class="form-control" name="message" id="message">Type your message...</textarea>
              </div>
              <input type="submit" value="Send Message" class="btn btn-success">
          </form>
      </div>
  </div>
@endsection