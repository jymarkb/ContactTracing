package com.example.qrcodescanner.Common.login;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;

import com.example.qrcodescanner.Common.Splash;
import com.example.qrcodescanner.Common.signup.signup_first_form;
import com.example.qrcodescanner.R;

public class login extends AppCompatActivity {

    Button btnVSend, btnVSignup;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);

        btnVSend  = findViewById(R.id.btnSendV);
        btnVSignup = findViewById(R.id.btnSignUp);


    }


    public void getVerification(View view) {
        Intent intent = new Intent(login.this, login_verification.class);
        intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TASK| Intent.FLAG_ACTIVITY_NEW_TASK);
        login.this.startActivity(intent);
    }

    public void getNewUser(View view){
        Intent intent = new Intent(login.this, signup_first_form.class);
        intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TASK| Intent.FLAG_ACTIVITY_NEW_TASK);
        login.this.startActivity(intent);
    }

}
