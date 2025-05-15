package com.example.qrcodescanner.Common.signup;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.Toast;

import com.example.qrcodescanner.Common.login.login;
import com.example.qrcodescanner.R;

public class signup_third_form extends AppCompatActivity {

    private long backPressTime;

    Button btnVSignUpNext,btnVResend;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_signup_third_form);

        btnVSignUpNext = findViewById(R.id.btnSignUpNext);
        btnVResend = findViewById(R.id.btnResend);

        btnVSignUpNext.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                getSummary();
            }
        });
    }



    public void getSummary() {
        Intent intent = new Intent(signup_third_form.this, signup_fourth_form.class);
        intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TASK| Intent.FLAG_ACTIVITY_NEW_TASK);
        signup_third_form.this.startActivity(intent);
    }

    @Override
    public void onBackPressed() {
        if (backPressTime + 2000 > System.currentTimeMillis()){
            Intent intent = new Intent(signup_third_form.this, login.class);
            intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TASK| Intent.FLAG_ACTIVITY_NEW_TASK);
            signup_third_form.this.startActivity(intent);
        }else{
            Toast.makeText(this, "Press back again to cancel registration", Toast.LENGTH_SHORT).show();
        }
        backPressTime = System.currentTimeMillis();
    }
}