import{a as k,b as E,_ as S}from"./AppLayout-CUasOcdi.js";import{_ as T}from"./NoChannelsFound-SKUyYYp8.js";import{j as q,r as g,o as a,d as f,a as e,t as p,u as s,b as o,w as n,f as x,e as v,c as _,p as I,F as V,q as Y,T as B,h as F,g as H}from"./app-tw8mqVIS.js";import{m as y,S as N,_ as j,a as z,F as D,b as A,N as L}from"./TextAreaInput-Kq0bz0uc.js";import{_ as O}from"./DialogModal-OmfWyWRI.js";import{_ as w}from"./PrimaryButton-B8UK-T2X.js";import{_ as R}from"./Modal-Bygz7JTY.js";import{_ as U}from"./TextInput-DpRHoIym.js";import"./_plugin-vue_export-helper-DlAUqK2U.js";const W={class:"rounded-md shadow-md border border-gray-200"},Z={class:"p-2 text-gray-500 flex items-center justify-between gap-4 border-b border-b-gray-200"},G={class:"flex items-center gap-2"},J=e("i",{class:"fa-brands fa-facebook text-blue-500"},null,-1),K={key:0,class:"text-xs font-bold"},Q={key:1,class:"text-xs font-bold"},X=e("button",{type:"button"},[e("i",{class:"fa-solid fa-ellipsis text-xl hover:text-gray-600"})],-1),ee=e("i",{class:"fa-solid fa-chart-simple"},null,-1),se=e("span",null,"Analytics",-1),te=e("i",{class:"fa-solid fa-copy"},null,-1),le=e("span",null,"Duplicate",-1),ae=e("i",{class:"fa-solid fa-eye"},null,-1),ne=e("span",null,"Visit",-1),oe={class:"p-2 flex flex-col-reverse sm:flex-row gap-5"},ie=["innerHTML"],re=["src"],ce={key:1,class:"w-72 aspect-video self-center",controls:""},de=["src"],ue={class:"flex items-center justify-between gap-2"},fe=e("span",{class:"space-x-2"},[e("i",{class:"fa-solid fa-chart-simple"}),e("span",null,"Post Analytics")],-1),he=e("i",{class:"fa-solid fa-arrows-rotate"},null,-1),me={key:0,class:"flex items-center justify-around gap-4 mt-8"},pe={class:"flex flex-col items-center gap-3"},_e=e("img",{class:"w-28 aspect-video",src:"https://post-planner.ca/images/facebook_reactions.png",alt:"facebook reactions"},null,-1),xe={class:"text-gray-500"},be={class:"flex flex-col items-center gap-3"},ye=e("i",{class:"fa-solid fa-comment text-6xl text-amber-500"},null,-1),ge={class:"text-gray-500"},ve={class:"flex flex-col items-center gap-3"},Ce=e("i",{class:"fa-solid fa-share text-6xl text-gray-700"},null,-1),$e={class:"text-gray-500"},we={__name:"FacebookPost",props:{post:{type:Object,required:!0}},setup(t){let r=t;const m=q(()=>{var i;return(i=r.post.description)==null?void 0:i.split(`
`).join("<br/>")});let c=g(!1),l=g({}),d=g(!1),C=g(!1);const $=async i=>{c.value=!0,d.value=!0;let u=await axios.get(`/api/analytics/${i}`);l.value=u.data,d.value=!1},h=i=>{Y.post("/duplicate/post",{postID:i},{onStart:u=>{C.value=!0},onFinish:u=>{C.value=!1}})};return(i,u)=>(a(),f(V,null,[e("div",W,[e("div",Z,[e("span",G,[J,t.post.is_published?(a(),f("span",K,"Created on "+p(t.post.scheduled_time?s(y).tz(t.post.scheduled_time,s(y).tz.guess()).format("dddd DD MMMM YYYY HH:mm:ss Z"):s(y).tz(t.post.created_at,s(y).tz.guess()).format("YYYY-MM-DD HH:mm:ss Z")),1)):(a(),f("span",Q,"Scheduled to "+p(s(y).tz(t.post.scheduled_time,s(y).tz.guess()).format("dddd DD MMMM YYYY HH:mm:ss Z")),1))]),o(E,null,{trigger:n(()=>[X]),content:n(()=>[o(k,{onClick:u[0]||(u[0]=b=>$(t.post.id)),as:"button"},{default:n(()=>[ee,se]),_:1}),o(k,{disabled:s(C),onClick:u[1]||(u[1]=b=>h(t.post.id)),as:"button"},{default:n(()=>[te,le]),_:1},8,["disabled"]),o(k,{as:"a",target:"_blank",href:t.post.original_link},{default:n(()=>[ae,ne]),_:1},8,["href"])]),_:1})]),e("div",oe,[e("p",{class:"text-sm flex-1",innerHTML:m.value??""},null,8,ie),t.post.file_type==="image"?(a(),f("img",{key:0,class:"w-60 aspect-square mx-auto sm:mx-0",src:"/storage/"+t.post.file_path,alt:"post image"},null,8,re)):t.post.file_type==="video"?(a(),f("video",ce,[e("source",{src:"/storage/"+t.post.file_path,type:"video/mp4"},null,8,de),x(" Your browser does not support the video tag. ")])):v("",!0)])]),o(O,{show:s(c)},{title:n(()=>[e("h1",ue,[fe,o(w,{disabled:s(d),onClick:u[2]||(u[2]=b=>$(t.post.id))},{default:n(()=>[he]),_:1},8,["disabled"])])]),content:n(()=>{var b,M,P;return[s(d)?(a(),_(N,{key:1})):(a(),f("div",me,[e("div",pe,[_e,e("span",xe,p(((b=s(l))==null?void 0:b.reactions)??0)+" Reactions",1)]),e("div",be,[ye,e("span",ge,p(((M=s(l))==null?void 0:M.comments)??0)+" Comments",1)]),e("div",ve,[Ce,e("span",$e,p(((P=s(l))==null?void 0:P.shares)??0)+" Shares",1)])]))]}),footer:n(()=>[o(w,{onClick:u[3]||(u[3]=b=>I(c)?c.value=!1:c=!1)},{default:n(()=>[x("Close")]),_:1})]),_:1},8,["show"])],64))}},ke=e("div",{class:"px-6 pt-4 text-lg font-medium text-gray-900"}," Create new post ",-1),De={class:"px-6 pb-4 mt-4 text-sm text-gray-600 space-y-4"},Ie={class:"space-y-1"},Me={class:"space-y-1"},Pe={key:0,class:"space-y-1"},Ve={class:"flex flex-row justify-end items-center gap-2 px-6 py-4 bg-gray-100 text-right rounded-b-md"},Ye={__name:"CreatePostModal",props:{show:{type:Boolean,default:!1},maxWidth:{type:String,default:"2xl"},closeable:{type:Boolean,default:!0},currentChannelID:{required:!0}},emits:["close"],setup(t,{emit:r}){const m=r,l=B({channelID:t.currentChannelID,description:null,file:null,fileTitle:null}),d=()=>{l.reset(),m("close")},C=async()=>{l.post("/publish/post",{onSuccess:$=>{d()}})};return($,h)=>(a(),_(R,{show:t.show,"max-width":t.maxWidth,closeable:t.closeable,onClose:d},{default:n(()=>[ke,e("form",{onSubmit:F(C,["prevent"])},[e("div",De,[o(j,{showCurrentChannelName:!0,onChangeChannel:h[0]||(h[0]=i=>s(l).channelID=i),currentChannelID:s(l).channelID},null,8,["currentChannelID"]),e("div",Ie,[o(z,{modelValue:s(l).description,"onUpdate:modelValue":h[1]||(h[1]=i=>s(l).description=i),placeholder:"Write a description",rows:"10"},null,8,["modelValue"]),s(l).errors.description?(a(),_(D,{key:0},{default:n(()=>[x(p(s(l).errors.description),1)]),_:1})):v("",!0)]),e("div",Me,[o(A,{modelValue:s(l).file,"onUpdate:modelValue":h[2]||(h[2]=i=>s(l).file=i)},null,8,["modelValue"]),s(l).errors.file?(a(),_(D,{key:0},{default:n(()=>[x(p(s(l).errors.file),1)]),_:1})):v("",!0)]),s(l).file?(a(),f("div",Pe,[o(U,{modelValue:s(l).fileTitle,"onUpdate:modelValue":h[3]||(h[3]=i=>s(l).fileTitle=i),placeholder:"file title",class:"w-full"},null,8,["modelValue"]),s(l).errors.fileTitle?(a(),_(D,{key:0},{default:n(()=>[x(p(s(l).errors.fileTitle),1)]),_:1})):v("",!0)])):v("",!0)]),e("div",Ve,[o(w,{type:"button",onClick:d,disabled:s(l).processing},{default:n(()=>[x("Cancel")]),_:1},8,["disabled"]),o(w,{type:"submit",disabled:s(l).processing},{default:n(()=>[x("Create")]),_:1},8,["disabled"])])],32)]),_:1},8,["show","max-width","closeable"]))}},je={class:"p-4"},Ee={class:"relative flex justify-between items-center gap-4"},Se=e("h3",{class:"text-gray-500 text-sm sm:text-base"},"Published Posts",-1),Te={key:0,class:"flex items-center gap-1"},qe=e("i",{class:"fa-solid fa-plus text-xs"},null,-1),Be=[qe],Fe={key:1,class:"text-xs text-red-500 text-italic"},He={class:"mt-6 space-y-8"},Ne={__name:"PublishContent",props:{posts:{type:Object,required:!0},channelsExists:{type:Boolean},currentChannelID:{required:!0}},setup(t){let r=g(!1);const m=c=>{Y.get("/publish",{pageID:c})};return(c,l)=>(a(),f("div",je,[e("div",Ee,[Se,t.channelsExists?(a(),f("div",Te,[o(j,{onChangeChannel:m,currentChannelID:t.currentChannelID},null,8,["currentChannelID"]),e("button",{onClick:l[0]||(l[0]=d=>I(r)?r.value=!0:r=!0),class:"px-3 py-2 bg-blue-500 text-white rounded-md cursor-pointer space-x-1 hover:bg-blue-600 text-sm sm:text-base",type:"button"},Be),o(Ye,{show:s(r),onClose:l[1]||(l[1]=d=>I(r)?r.value=!1:r=!1),currentChannelID:t.currentChannelID},null,8,["show","currentChannelID"])])):(a(),f("p",Fe," You didn't connect any channels yet "))]),e("div",He,[(a(!0),f(V,null,H(t.posts.data,d=>(a(),_(we,{key:d.id,post:d},null,8,["post"]))),128)),o(T,{links:t.posts.links},null,8,["links"])]),t.posts.data.length?v("",!0):(a(),_(L,{key:0}))]))}},ze={class:"py-12"},Ae={class:"max-w-7xl mx-auto sm:px-6 lg:px-8"},Le={class:"bg-white shadow-xl sm:rounded-lg"},Xe={__name:"Publish",props:{posts:{type:Object,required:!0},channelsExists:{type:Boolean},currentChannelID:{required:!0}},setup(t){let r=t,m=g(null);return Echo.private(`refresh-posts-${r.currentChannelID}`).listen("RefreshPublishedPosts",c=>{c.pageID==r.currentChannelID&&(m.value=c.publishedPosts)}),(c,l)=>(a(),_(S,{title:"Publish"},{default:n(()=>[e("div",ze,[e("div",Ae,[e("div",Le,[o(Ne,{posts:s(m)??t.posts,channelsExists:t.channelsExists,currentChannelID:t.currentChannelID},null,8,["posts","channelsExists","currentChannelID"])])])])]),_:1}))}};export{Xe as default};