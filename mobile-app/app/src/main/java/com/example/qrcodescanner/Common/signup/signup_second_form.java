package com.example.qrcodescanner.Common.signup;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.AutoCompleteTextView;
import android.widget.Button;
import android.widget.ImageView;

import com.example.qrcodescanner.Common.login.login;
import com.example.qrcodescanner.R;
import com.google.android.material.textfield.TextInputLayout;

public class signup_second_form extends AppCompatActivity {

    private long backPressTime;

    private TextInputLayout txtInputV_dropdown_gender, txtInputV_dropdown_month;
    private AutoCompleteTextView autoV_dropdown_gender, autoV_dropdown_month;

    ImageView imgVSignUpBack;
    Button btnVSignUpNext,btnVSignUpLogin;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_signup_second_form);


        txtInputV_dropdown_gender = findViewById(R.id.dropdown_gender);
        autoV_dropdown_gender = findViewById(R.id.autoComplete_gender);

        txtInputV_dropdown_month = findViewById(R.id.dropdown_month);
        autoV_dropdown_month = findViewById(R.id.autoComplete_month);


        //Buttons links
        imgVSignUpBack = findViewById(R.id.btnImgSignUpBack);
        btnVSignUpNext = findViewById(R.id.btnSignUpNext);
        btnVSignUpLogin = findViewById(R.id.btnLogin);
        imgVSignUpBack.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                getBack();
            }
        });
        btnVSignUpNext.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                getNext();
            }
        });
        btnVSignUpLogin.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                getLogin();
            }
        });
        //Button Links



        String [] gender = new String[]{"Male", "Female"};
        String [] month = new String[]{"January", "February", "March", "April","May", "June", "July", "August", "September", "October", "November", "December"};
        ArrayAdapter<String> genderAdapter = new ArrayAdapter<>(signup_second_form.this, R.layout.dropdown_item,gender);
        autoV_dropdown_gender.setAdapter(genderAdapter);
        ArrayAdapter<String> monthAdapter = new ArrayAdapter<>(signup_second_form.this, R.layout.dropdown_item,month);
        autoV_dropdown_month.setAdapter(monthAdapter);
    }

    public void getBack() {
        Intent intent = new Intent(signup_second_form.this, signup_first_form.class);
        intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TASK| Intent.FLAG_ACTIVITY_NEW_TASK);
        signup_second_form.this.startActivity(intent);
    }


    public void getNext() {
        Intent intent = new Intent(signup_second_form.this, signup_third_form.class);
        intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TASK| Intent.FLAG_ACTIVITY_NEW_TASK);
        signup_second_form.this.startActivity(intent);
    }


    public void getLogin(){
        Intent intent = new Intent(signup_second_form.this, login.class);
        intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TASK| Intent.FLAG_ACTIVITY_NEW_TASK);
        signup_second_form.this.startActivity(intent);
    }


    @Override
    public void onBackPressed() {
        if (backPressTime + 2000 > System.currentTimeMillis()){
            super.onBackPressed();
            return;
        }else{
            getBack();
        }
        backPressTime = System.currentTimeMillis();

    }
}