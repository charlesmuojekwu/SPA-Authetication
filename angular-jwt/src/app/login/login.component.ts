import { HttpClient } from '@angular/common/http';
import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup } from '@angular/forms';
import { Router } from '@angular/router';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit {

  formLogin!: FormGroup;
  error!: string;

  constructor(private formBuilder: FormBuilder, private http: HttpClient, private router: Router) { }

  ngOnInit(): void {
    this.formLogin = this.formBuilder.group({
      email: '',
      password: ''
    }); 

  }

  submitLogin(): void {
    this.http.post('http://localhost:8000/api/login',this.formLogin.getRawValue(),{withCredentials:true})
      .subscribe(() => {
        this.router.navigate(['/']);
      },error => {
        this.error = error.error.message;
      })
  }

}
