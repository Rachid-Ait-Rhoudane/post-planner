import{o,d as n,a as t,r as M,j as k,Q as B,s as D,n as f,e as h,t as w,h as x,I as N,J as q,m,p as j,u as g,k as L,A as P,b as l,w as r,D as E,c as b,i as S,Z as O,f as u,F as $,g as z,q as A}from"./app-tw8mqVIS.js";import{_ as V}from"./_plugin-vue_export-helper-DlAUqK2U.js";const I={},Q={viewBox:"0 0 48 48",fill:"none",xmlns:"http://www.w3.org/2000/svg"},R=t("path",{d:"M11.395 44.428C4.557 40.198 0 32.632 0 24 0 10.745 10.745 0 24 0a23.891 23.891 0 0113.997 4.502c-.2 17.907-11.097 33.245-26.602 39.926z",fill:"#6875F5"},null,-1),H=t("path",{d:"M14.134 45.885A23.914 23.914 0 0024 48c13.255 0 24-10.745 24-24 0-3.516-.756-6.856-2.115-9.866-4.659 15.143-16.608 27.092-31.75 31.751z",fill:"#6875F5"},null,-1),J=[R,H];function U(i,a){return o(),n("svg",Q,J)}const Z=V(I,[["render",U]]),G={class:"max-w-screen-xl mx-auto py-2 px-3 sm:px-6 lg:px-8"},K={class:"flex items-center justify-between flex-wrap"},W={class:"w-0 flex-1 flex items-center min-w-0"},X={key:0,class:"h-5 w-5 text-white",xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24","stroke-width":"1.5",stroke:"currentColor"},Y=t("path",{"stroke-linecap":"round","stroke-linejoin":"round",d:"M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"},null,-1),ee=[Y],te={key:1,class:"h-5 w-5 text-white",xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24","stroke-width":"1.5",stroke:"currentColor"},se=t("path",{"stroke-linecap":"round","stroke-linejoin":"round",d:"M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"},null,-1),oe=[se],re={class:"ml-3 font-medium text-sm text-white truncate"},ae={class:"shrink-0 sm:ml-3"},ne=t("svg",{class:"h-5 w-5 text-white",xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24","stroke-width":"1.5",stroke:"currentColor"},[t("path",{"stroke-linecap":"round","stroke-linejoin":"round",d:"M6 18L18 6M6 6l12 12"})],-1),ie=[ne],le={__name:"Banner",setup(i){const a=M(!0),s=k(()=>{var e;return((e=B().props.jetstream.flash)==null?void 0:e.bannerStyle)||"success"}),c=k(()=>{var e;return((e=B().props.jetstream.flash)==null?void 0:e.banner)||""});return D(c,async()=>{a.value=!0}),(e,_)=>(o(),n("div",null,[a.value&&c.value?(o(),n("div",{key:0,class:f({"bg-indigo-500":s.value=="success","bg-red-700":s.value=="danger"})},[t("div",G,[t("div",K,[t("div",W,[t("span",{class:f(["flex p-2 rounded-lg",{"bg-indigo-600":s.value=="success","bg-red-600":s.value=="danger"}])},[s.value=="success"?(o(),n("svg",X,ee)):h("",!0),s.value=="danger"?(o(),n("svg",te,oe)):h("",!0)],2),t("p",re,w(c.value),1)]),t("div",ae,[t("button",{type:"button",class:f(["-mr-1 flex p-2 rounded-md focus:outline-none sm:-mr-2 transition",{"hover:bg-indigo-600 focus:bg-indigo-600":s.value=="success","hover:bg-red-600 focus:bg-red-600":s.value=="danger"}]),"aria-label":"Dismiss",onClick:_[0]||(_[0]=x(d=>a.value=!1,["prevent"]))},ie,2)])])])],2)):h("",!0)]))}},ue={class:"relative"},F={__name:"Dropdown",props:{align:{type:String,default:"right"},width:{type:String,default:"48"},contentClasses:{type:Array,default:()=>["py-1","bg-white"]}},setup(i){const a=i;let s=M(!1);const c=d=>{s.value&&d.key==="Escape"&&(s.value=!1)};N(()=>document.addEventListener("keydown",c)),q(()=>document.removeEventListener("keydown",c));const e=k(()=>({48:"w-48"})[a.width.toString()]),_=k(()=>a.align==="left"?"origin-top-left left-0":a.align==="right"?"origin-top-right right-0":"origin-top");return(d,v)=>(o(),n("div",ue,[t("div",{onClick:v[0]||(v[0]=T=>j(s)?s.value=!g(s):s=!g(s))},[m(d.$slots,"trigger")]),L(t("div",{onClick:v[1]||(v[1]=T=>j(s)?s.value=!1:s=!1),class:"fixed inset-0 bg-black/10 z-40"},null,512),[[P,g(s)]]),l(E,{"enter-active-class":"transition ease-out duration-200","enter-from-class":"transform opacity-0 scale-95","enter-to-class":"transform opacity-100 scale-100","leave-active-class":"transition ease-in duration-75","leave-from-class":"transform opacity-100 scale-100","leave-to-class":"transform opacity-0 scale-95"},{default:r(()=>[L(t("div",{class:f(["absolute z-50 mt-2 rounded-md shadow-lg",[e.value,_.value]]),style:{display:"none"},onClick:v[2]||(v[2]=T=>j(s)?s.value=!1:s=!1)},[t("div",{class:f(["rounded-md ring-1 ring-black ring-opacity-5",i.contentClasses])},[m(d.$slots,"content")],2)],2),[[P,g(s)]])]),_:3})]))}},de=["disabled"],ce=["target","href"],y={__name:"DropdownLink",props:{href:String,as:String,target:String,disabled:Boolean,active:Boolean},setup(i){return(a,s)=>(o(),n("div",null,[i.as=="button"?(o(),n("button",{key:0,disabled:i.disabled,type:"submit",class:f(["flex items-center gap-1 w-full px-4 py-2 text-left text-sm leading-5 text-gray-700 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out disabled:text-gray-500 disabled:cursor-not-allowed",{"hover:bg-gray-100":!i.disabled}])},[m(a.$slots,"default")],10,de)):i.as=="a"?(o(),n("a",{key:1,target:i.target,href:i.href,class:"flex items-center gap-1 px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out"},[m(a.$slots,"default")],8,ce)):(o(),b(g(S),{key:2,href:i.href,class:f(["block px-4 py-2 text-sm leading-5 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out",{"bg-indigo-500 text-white":i.active,"bg-transparent text-gray-700 hover:bg-gray-100":!i.active}])},{default:r(()=>[m(a.$slots,"default")]),_:3},8,["href","class"]))]))}},C={__name:"NavLink",props:{href:String,active:Boolean},setup(i){const a=i,s=k(()=>a.active?"inline-flex items-center px-1 pt-1 border-b-2 border-indigo-400 text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out":"inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out");return(c,e)=>(o(),b(g(S),{href:i.href,class:f(s.value)},{default:r(()=>[m(c.$slots,"default")]),_:3},8,["href","class"]))}},p={__name:"ResponsiveNavLink",props:{active:Boolean,href:String,as:String},setup(i){const a=i,s=k(()=>a.active?"block w-full pl-3 pr-4 py-2 border-l-4 border-indigo-400 text-left text-base font-medium text-indigo-700 bg-indigo-50 focus:outline-none focus:text-indigo-800 focus:bg-indigo-100 focus:border-indigo-700 transition duration-150 ease-in-out":"block w-full pl-3 pr-4 py-2 border-l-4 border-transparent text-left text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out");return(c,e)=>(o(),n("div",null,[i.as=="button"?(o(),n("button",{key:0,class:f([s.value,"w-full text-left"])},[m(c.$slots,"default")],2)):(o(),b(g(S),{key:1,href:i.href,class:f(s.value)},{default:r(()=>[m(c.$slots,"default")]),_:3},8,["href","class"]))]))}},he={class:"min-h-screen bg-gray-100"},fe={class:"bg-white border-b border-gray-100"},pe={class:"max-w-7xl mx-auto px-4 sm:px-6 lg:px-8"},ge={class:"flex justify-between h-16"},me={class:"flex"},ve={class:"shrink-0 flex items-center"},be={class:"hidden space-x-8 sm:-my-px sm:ml-10 sm:flex"},_e={class:"hidden sm:flex sm:items-center sm:ml-6"},ye={class:"ml-3 relative"},we={class:"inline-flex rounded-md"},ke={type:"button",class:"inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150"},xe=t("svg",{class:"ml-2 -mr-0.5 h-4 w-4",xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24","stroke-width":"1.5",stroke:"currentColor"},[t("path",{"stroke-linecap":"round","stroke-linejoin":"round",d:"M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"})],-1),$e={class:"w-60"},Ce=t("div",{class:"block px-4 py-2 text-xs text-gray-400"}," Manage Team ",-1),Se=t("div",{class:"border-t border-gray-200"},null,-1),je=t("div",{class:"block px-4 py-2 text-xs text-gray-400"}," Switch Teams ",-1),Me=["onSubmit"],Te={class:"flex items-center"},Be={key:0,class:"mr-2 h-5 w-5 text-green-400",xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24","stroke-width":"1.5",stroke:"currentColor"},Le=t("path",{"stroke-linecap":"round","stroke-linejoin":"round",d:"M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"},null,-1),Pe=[Le],ze={class:"ml-3 relative"},Ae={key:0,class:"flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition"},Fe=["src","alt"],De={key:1,class:"inline-flex rounded-md"},Ne={type:"button",class:"inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150"},qe=t("svg",{class:"ml-2 -mr-0.5 h-4 w-4",xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24","stroke-width":"1.5",stroke:"currentColor"},[t("path",{"stroke-linecap":"round","stroke-linejoin":"round",d:"M19.5 8.25l-7.5 7.5-7.5-7.5"})],-1),Ee=t("div",{class:"block px-4 py-2 text-xs text-gray-400"}," Manage Account ",-1),Oe=t("div",{class:"border-t border-gray-200"},null,-1),Ve={class:"-mr-2 flex items-center sm:hidden"},Ie={class:"h-6 w-6",stroke:"currentColor",fill:"none",viewBox:"0 0 24 24"},Qe={class:"pt-2 pb-3 space-y-1"},Re={class:"pt-4 pb-1 border-t border-gray-200"},He={class:"flex items-center px-4"},Je={key:0,class:"shrink-0 mr-3"},Ue=["src","alt"],Ze={class:"font-medium text-base text-gray-800"},Ge={class:"font-medium text-sm text-gray-500"},Ke={class:"mt-3 space-y-1"},We=t("div",{class:"border-t border-gray-200"},null,-1),Xe=t("div",{class:"block px-4 py-2 text-xs text-gray-400"}," Manage Team ",-1),Ye=t("div",{class:"border-t border-gray-200"},null,-1),et=t("div",{class:"block px-4 py-2 text-xs text-gray-400"}," Switch Teams ",-1),tt=["onSubmit"],st={class:"flex items-center"},ot={key:0,class:"mr-2 h-5 w-5 text-green-400",xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24","stroke-width":"1.5",stroke:"currentColor"},rt=t("path",{"stroke-linecap":"round","stroke-linejoin":"round",d:"M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"},null,-1),at=[rt],lt={__name:"AppLayout",props:{title:String},setup(i){const a=M(!1),s=e=>{A.put(route("current-team.update"),{team_id:e.id},{preserveState:!1})},c=()=>{A.post(route("logout"))};return(e,_)=>(o(),n("div",null,[l(g(O),{title:i.title},null,8,["title"]),l(le),t("div",he,[t("nav",fe,[t("div",pe,[t("div",ge,[t("div",me,[t("div",ve,[l(g(S),{href:e.route("dashboard")},{default:r(()=>[l(Z,{class:"block h-9 w-auto"})]),_:1},8,["href"])]),t("div",be,[l(C,{href:e.route("dashboard"),active:e.route().current("dashboard")},{default:r(()=>[u(" Dashboard ")]),_:1},8,["href","active"]),l(C,{href:e.route("channels"),active:e.route().current("channels")},{default:r(()=>[u(" Channels ")]),_:1},8,["href","active"]),l(C,{href:e.route("publish"),active:e.route().current("publish")},{default:r(()=>[u(" Publish ")]),_:1},8,["href","active"]),l(C,{href:e.route("queue"),active:e.route().current("queue")},{default:r(()=>[u(" Queue ")]),_:1},8,["href","active"])])]),t("div",_e,[t("div",ye,[e.$page.props.jetstream.hasTeamFeatures?(o(),b(F,{key:0,align:"right",width:"60"},{trigger:r(()=>[t("span",we,[t("button",ke,[u(w(e.$page.props.auth.user.current_team.name)+" ",1),xe])])]),content:r(()=>[t("div",$e,[e.$page.props.jetstream.hasTeamFeatures?(o(),n($,{key:0},[Ce,l(y,{href:e.route("teams.show",e.$page.props.auth.user.current_team)},{default:r(()=>[u(" Team Settings ")]),_:1},8,["href"]),e.$page.props.jetstream.canCreateTeams?(o(),b(y,{key:0,href:e.route("teams.create")},{default:r(()=>[u(" Create New Team ")]),_:1},8,["href"])):h("",!0),Se,je,(o(!0),n($,null,z(e.$page.props.auth.user.all_teams,d=>(o(),n("form",{key:d.id,onSubmit:x(v=>s(d),["prevent"])},[l(y,{as:"button"},{default:r(()=>[t("div",Te,[d.id==e.$page.props.auth.user.current_team_id?(o(),n("svg",Be,Pe)):h("",!0),t("div",null,w(d.name),1)])]),_:2},1024)],40,Me))),128))],64)):h("",!0)])]),_:1})):h("",!0)]),t("div",ze,[l(F,{align:"right",width:"48"},{trigger:r(()=>[e.$page.props.jetstream.managesProfilePhotos?(o(),n("button",Ae,[t("img",{class:"h-8 w-8 rounded-full object-cover",src:e.$page.props.auth.user.profile_photo_url,alt:e.$page.props.auth.user.name},null,8,Fe)])):(o(),n("span",De,[t("button",Ne,[u(w(e.$page.props.auth.user.name)+" ",1),qe])]))]),content:r(()=>[Ee,l(y,{href:e.route("profile.show"),active:e.route().current("profile.show")},{default:r(()=>[u(" Profile ")]),_:1},8,["href","active"]),l(y,{href:e.route("profile.settings"),active:e.route().current("profile.settings")},{default:r(()=>[u(" Settings ")]),_:1},8,["href","active"]),e.$page.props.jetstream.hasApiFeatures?(o(),b(y,{key:0,href:e.route("api-tokens.index")},{default:r(()=>[u(" API Tokens ")]),_:1},8,["href"])):h("",!0),Oe,t("form",{onSubmit:x(c,["prevent"])},[l(y,{as:"button"},{default:r(()=>[u(" Log Out ")]),_:1})],32)]),_:1})])]),t("div",Ve,[t("button",{class:"inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out",onClick:_[0]||(_[0]=d=>a.value=!a.value)},[(o(),n("svg",Ie,[t("path",{class:f({hidden:a.value,"inline-flex":!a.value}),"stroke-linecap":"round","stroke-linejoin":"round","stroke-width":"2",d:"M4 6h16M4 12h16M4 18h16"},null,2),t("path",{class:f({hidden:!a.value,"inline-flex":a.value}),"stroke-linecap":"round","stroke-linejoin":"round","stroke-width":"2",d:"M6 18L18 6M6 6l12 12"},null,2)]))])])])]),t("div",{class:f([{block:a.value,hidden:!a.value},"sm:hidden"])},[t("div",Qe,[l(p,{href:e.route("dashboard"),active:e.route().current("dashboard")},{default:r(()=>[u(" Dashboard ")]),_:1},8,["href","active"]),l(p,{href:e.route("channels"),active:e.route().current("channels")},{default:r(()=>[u(" Channels ")]),_:1},8,["href","active"]),l(p,{href:e.route("publish"),active:e.route().current("publish")},{default:r(()=>[u(" Publish ")]),_:1},8,["href","active"]),l(p,{href:e.route("queue"),active:e.route().current("queue")},{default:r(()=>[u(" Queue ")]),_:1},8,["href","active"])]),t("div",Re,[t("div",He,[e.$page.props.jetstream.managesProfilePhotos?(o(),n("div",Je,[t("img",{class:"h-10 w-10 rounded-full object-cover",src:e.$page.props.auth.user.profile_photo_url,alt:e.$page.props.auth.user.name},null,8,Ue)])):h("",!0),t("div",null,[t("div",Ze,w(e.$page.props.auth.user.name),1),t("div",Ge,w(e.$page.props.auth.user.email),1)])]),t("div",Ke,[l(p,{href:e.route("profile.show"),active:e.route().current("profile.show")},{default:r(()=>[u(" Profile ")]),_:1},8,["href","active"]),e.$page.props.jetstream.hasApiFeatures?(o(),b(p,{key:0,href:e.route("api-tokens.index"),active:e.route().current("api-tokens.index")},{default:r(()=>[u(" API Tokens ")]),_:1},8,["href","active"])):h("",!0),t("form",{method:"POST",onSubmit:x(c,["prevent"])},[l(p,{as:"button"},{default:r(()=>[u(" Log Out ")]),_:1})],32),e.$page.props.jetstream.hasTeamFeatures?(o(),n($,{key:1},[We,Xe,l(p,{href:e.route("teams.show",e.$page.props.auth.user.current_team),active:e.route().current("teams.show")},{default:r(()=>[u(" Team Settings ")]),_:1},8,["href","active"]),e.$page.props.jetstream.canCreateTeams?(o(),b(p,{key:0,href:e.route("teams.create"),active:e.route().current("teams.create")},{default:r(()=>[u(" Create New Team ")]),_:1},8,["href","active"])):h("",!0),Ye,et,(o(!0),n($,null,z(e.$page.props.auth.user.all_teams,d=>(o(),n("form",{key:d.id,onSubmit:x(v=>s(d),["prevent"])},[l(p,{as:"button"},{default:r(()=>[t("div",st,[d.id==e.$page.props.auth.user.current_team_id?(o(),n("svg",ot,at)):h("",!0),t("div",null,w(d.name),1)])]),_:2},1024)],40,tt))),128))],64)):h("",!0)])])],2)]),t("main",null,[m(e.$slots,"default")])])]))}};export{lt as _,y as a,F as b};