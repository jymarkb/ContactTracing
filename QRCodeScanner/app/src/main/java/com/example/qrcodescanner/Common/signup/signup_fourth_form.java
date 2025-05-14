package com.example.qrcodescanner.Common.signup;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;

import com.example.qrcodescanner.Common.login.login;
import com.example.qrcodescanner.R;

public class signup_fourth_form extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_signup_fourth_form);
    }

    public void getLogin(View view) {
        Intent intent = new Intent(signup_fourth_form.this, login.class);
        intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TASK| Intent.FLAG_ACTIVITY_NEW_TASK);
        signup_fourth_form.this.startActivity(intent);
    }
}