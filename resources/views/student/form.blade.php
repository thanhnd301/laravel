<?php
    $mSelected = 1;
    $student = null;
    if (isset($formData['student'])) {
        $student = $formData['student'];
        $mSelected = $student->general;
    }
?>

@extends('adminlte::layouts.app')

@section('contentheader_title')
    <?php echo $formData['title']?>
@endsection

@section('main-content')
    <div class="card uper">
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div><br />
            @endif
            <form method="post" action="<?php echo $formData['url'] ?>">
                @if($student)
                    <input type="hidden" class="form-control" name="student_id" value="{{ $student->id }}"/>
                @endif
                <div class="form-group">
                    @csrf
                    <label for="name">Email:</label>
                    <input type="text" class="form-control" name="email" required <?php if($student) echo 'value="'.$student->email.'"' ?>/>
                </div>
                <div class="form-group">
                    <label for="name">Student Name:</label>
                    <input type="text" class="form-control" name="name" required <?php if($student) echo 'value="'.$student->name.'"' ?> />
                </div>
                <div class="form-group">
                    <label for="dob">Birthday:</label>
                    <input type="text" class="form-control" name="dob" <?php if($student) echo 'value="'.$student->dob.'"' ?> />
                </div>
                <div class="form-group">
                    <label for="quantity">General:</label>
                    <select class="form-control" name="general">
                        <option <?php if($mSelected) echo 'selected="selected"' ?> value="1">Male</option>
                        <option <?php if(!$mSelected) echo 'selected="selected"' ?> value="0">Female</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary"><?php echo $formData['title']?></button>
            </form>
        </div>
    </div>
@endsection