import 'package:crud_mysql/function/func_isLoading.dart';
import 'package:flutter/material.dart';
import 'package:dio/dio.dart';
import 'dart:developer';
import 'package:fluttertoast/fluttertoast.dart';
import 'func_isLoading.dart';
import 'func_handleNull.dart';

Response<dynamic>? response;

Future<dynamic> login(context, username, password) async {
  String user, pwd;
  user = username.toString();
  pwd = password.toString();

  //jika username dan password kosong jalankan fungsi handle pada file handleNull.
  if (user == "" || pwd == "") {
    log("If pertama");
    handle("Semua data harus diisi!");
  }else{
  //tampil loading jika username dan password tidak kosong
  isLoading(context);
  //jika username bukan user dan password bukan qwerty, jalankan fungsi handle pada file handleNull.
  if (user != "user" && pwd !="qwerty") {
   log("If ketiga");
    Navigator.pop(context);
    handle("Usernama atau password salah!");
  } else {
    log("If kedua");
    return Navigator.of(context)
        .pushNamedAndRemoveUntil('/read', (Route<dynamic> route) => false);
  }
  }
}
