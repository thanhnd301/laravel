<?php
/**
 * Created by PhpStorm.
 * User: vagrant
 * Date: 12/31/19
 * Time: 3:51 AM
 */ ?>

@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Student Management
@endsection

@section('contentheader_title')
    Student Management
@endsection

@section('main-content')
    <style>
        .uper {
            margin-top: 40px;
        }
    </style>
    <div class="uper">
        @if(session()->get('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div><br />
        @endif
        <div>
            <a href="{{ route('students.create')}}" class="btn btn-primary">Create Student</a>
        </div>
        <table class="table table-striped">
            <thead>
            <tr>
                <td>ID</td>
                <td>Student Name</td>
                <td>Email</td>
                <td>Birthday</td>
                <td>General</td>
                <td colspan="2">Action</td>
            </tr>
            </thead>
            <tbody>
            @foreach($students as $student)
                <tr>
                    <td>{{$student->id}}</td>
                    <td>{{$student->name}}</td>
                    <td>{{$student->email}}</td>
                    <td>{{$student->dob}}</td>
                    <td>{{$student->general?'Male':'Female'}}</td>
                    <td><a href="{{ route('students.edit',$student->id)}}" class="btn btn-primary">Edit</a></td>
                    <td>
                        <form action="{{ route('students.destroy', $student->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div>
@endsection
