package com.example.qrcodescanner.Scanner;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.Toast;

import com.budiyev.android.codescanner.CodeScanner;
import com.budiyev.android.codescanner.CodeScannerView;
import com.budiyev.android.codescanner.DecodeCallback;
import com.example.qrcodescanner.MainActivity;
import com.example.qrcodescanner.R;
import com.google.zxing.Result;

public class scanner_in extends AppCompatActivity {

    Button btnVback;

    CodeScanner codeScanner;
    CodeScannerView scannerView;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_scanner_in);

        btnVback = findViewById(R.id.btnScannerBack);

        scannerView = findViewById(R.id.scanner_view_in);
        codeScanner = new CodeScanner(this, scannerView);
        codeScanner.startPreview();
        codeScanner.setDecodeCallback(new DecodeCallback() {
            @Override
            public void onDecoded(@NonNull final Result result) {
                runOnUiThread(new Runnable() {
                    @Override
                    public void run() {
                        if (!result.getText().equals("")){
                            Intent intent = new Intent(scanner_in.this, scanner_temperature.class);
                            intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TASK| Intent.FLAG_ACTIVITY_NEW_TASK);
                            scanner_in.this.startActivity(intent);
                        }
                    }
                });
            }
        });

        btnVback.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                getHome();
            }
        });
    }


    @Override
    public void onBackPressed() {
        getHome();
    }

    public  void  getHome(){
        Intent intent = new Intent(scanner_in.this, MainActivity.class);
        intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TASK| Intent.FLAG_ACTIVITY_NEW_TASK);
        scanner_in.this.startActivity(intent);
    }
}