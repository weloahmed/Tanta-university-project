@extends('student.app')
@section('nav')
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="{{url("/")}}" style="font-size: 25px">الإدارة الطبية</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/')}}">تسجيل بيانات الكشف الطبي </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/verify')}}">تحقق من الميعاد</a>
                </li>
                @guest("admin")
                @else
                <li class="nav-item active">
                    <a class="nav-link" href="{{url('/students')}}"><span class="sr-only">(current)</span>الطلاب</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/faculties')}}">الكليات</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/reservations')}}">المواعيد</a>
                </li>
                @endguest
                {{--                <li class="nav-item">--}}
                {{--                    <a class="nav-link" href="#">Pricing</a>--}}
                {{--                </li>--}}
                {{--                <li class="nav-item">--}}
                {{--                    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>--}}
                {{--                </li>--}}
            </ul>
        </div>
        @guest('admin')
            <a href="/admin/login" class="btn btn-outline-success my-2 my-sm-0 float-left">تسجيل الدخول</a>
        @else
            <a href="/dashboard" class="btn btn-outline-info my-2 my-sm-0 float-left">لوحة التحكم </a>
            <a href="/admin/logout" class="btn btn-outline-danger my-2 my-sm-0 float-left m-2">تسجيل الخروج</a>
        @endguest

    </nav>
@endsection
@section('content')
    <div class="container">
        <h1 class="text-center p-5">الطلاب الذين قاموا بالتسجيل</h1>
        <div class="form-group">
            @if(isset($student))
                <form action="{{route("update",$student->id)}}" method="post">
                    @method("PUT")
                    @csrf
                    <label for="name"> الاسم</label>
                    <input type="text" value="{{$student->name}}" placeholder="الاسم الرباعي كما في شهادة الميلاد / البطاقة" name="name" id="name" class="form-control @error('name') is-invalid @enderror">
                    @error('name')
                    <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                    <label for="email">البريد الإلكتروني</label>
                    <input  type="email" value="{{$student->email}}" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="البريد الاكتروني">
                    @error('email')
                    <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                    <label for="national_id">الرقم القومي</label>
                    <input  type="number"  value="{{$student->national_id}}" name="national_id" id="national_id" class="form-control @error('national_id') is-invalid @enderror" placeholder="الرقم القومي">
                    @error('national_id')
                    <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                    <label for="phone_num">رقم التليفون</label>
                    <input type="tel"  name="phone_num" value="{{$student->phone_num}}" id="phone_num" class="form-control @error('phone_num') is-invalid @enderror" placeholder="رقم التليقون">
                    @error('phone_num')
                    <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                    <label for="faculty">الكلية</label>
                    {{--                <input type="text" name="faculty" id="faculty" class="form-control @error('faculty') is-invalid @enderror" placeholder="الكلية">--}}
                    <select name="faculty" value="{{$student->faculty}}" id="faculty" class="form-control @error('faculty') is-invalid @enderror">
                        @if(isset($faculties) && !empty($faculties))
                            @foreach($faculties as $faculty)
                        <option value="{{$faculty->name}}">{{$faculty->name}}</option>
                            @endforeach
                        @endif
                    </select>
                    @error('faculty')
                    <div class="alert alert-danger">{{$message}}</div>
                    @enderror

                    <label for="date">ميعاد الكشف الطبي</label>
                    {{--                <input type="" name="phone_num" id="phone_num" class="form-control @error('phone_num') is-invalid @enderror" placeholder="رقم التليقون">--}}
                    <select name="date" id="date" value="{{$student->date}}" class="form-control @error('date') is-invalid @enderror">
                       @if(isset($dates) && !empty($dates))
                           @foreach($dates as $date)
                        <option value="{{$date->date}}">{{$date->date}}</option>
                            @endforeach
                        @endif
                    </select>
                    @error('date')
                    <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                    <div class="text-center">
                        <input type="submit" value="تحديث" class="btn btn-success m-2 align-content-center">
                        <a href="/students" class="btn btn-dark align-content-center">الغاء</a>

                    </div>

                </form>
            @endif
        </div>
    </div>
@endsection
