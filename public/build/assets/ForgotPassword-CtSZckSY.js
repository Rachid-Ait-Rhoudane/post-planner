import{T as d,o as m,d as i,b as e,u as a,w as o,F as c,Z as f,t as _,e as p,a as t,n as w,f as g,h as y}from"./app-Ykj0_Q_5.js";import{A as b}from"./AuthenticationCard-m9K6TqQU.js";import{_ as x}from"./AuthenticationCardLogo-lDBlSa0Q.js";import{_ as h}from"./InputError-BnbVg2F5.js";import{_ as k}from"./InputLabel-BSiS8_4g.js";import{_ as V}from"./PrimaryButton-C6IkBuS0.js";import{_ as v}from"./TextInput-D2Fy5zXw.js";import"./_plugin-vue_export-helper-DlAUqK2U.js";const F=t("div",{class:"mb-4 text-sm text-gray-600"}," Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one. ",-1),N={key:0,class:"mb-4 font-medium text-sm text-green-600"},$={class:"flex items-center justify-end mt-4"},z={__name:"ForgotPassword",props:{status:String},setup(l){const s=d({email:""}),n=()=>{s.post(route("password.email"))};return(C,r)=>(m(),i(c,null,[e(a(f),{title:"Forgot Password"}),e(b,null,{logo:o(()=>[e(x)]),default:o(()=>[F,l.status?(m(),i("div",N,_(l.status),1)):p("",!0),t("form",{onSubmit:y(n,["prevent"])},[t("div",null,[e(k,{for:"email",value:"Email"}),e(v,{id:"email",modelValue:a(s).email,"onUpdate:modelValue":r[0]||(r[0]=u=>a(s).email=u),type:"email",class:"mt-1 block w-full",required:"",autofocus:"",autocomplete:"username"},null,8,["modelValue"]),e(h,{class:"mt-2",message:a(s).errors.email},null,8,["message"])]),t("div",$,[e(V,{class:w({"opacity-25":a(s).processing}),disabled:a(s).processing},{default:o(()=>[g(" Email Password Reset Link ")]),_:1},8,["class","disabled"])])],32)]),_:1})],64))}};export{z as default};
