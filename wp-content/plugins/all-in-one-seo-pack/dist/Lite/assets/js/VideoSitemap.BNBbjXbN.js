import{_ as k}from"./_plugin-vue_export-helper.BN1snXvA.js";import{o as p,c as v,v as i,k as S,l as r,a as s,x as l,t as a,C as t,u as m,b}from"./runtime-dom.esm-bundler.DKw-RQqs.js";import{e as C,i as M,u as w}from"./index.ByF2aI-G.js";import"./translations.Ur07Kmot.js";import{_ as o,a as R}from"./default-i18n.DvLqo3S3.js";import{G as A}from"./constants.DfsCWbZk.js";import{C as N}from"./Blur.D3p3Plqi.js";import{C as V}from"./SettingsRow.Ch1FEDlp.js";import{S as P}from"./External.DwsNMWba.js";import{B as D}from"./RadioToggle.Cv8la4G_.js";import{R as H}from"./RequiredPlans.Cd-RNSMK.js";import{C as O}from"./Card.Bqq4cvaT.js";import{C as U}from"./ProBadge.BJ3spTo5.js";import{C as E}from"./Index.BQLC1nYH.js";import{u as F}from"./AddonConditions.DhxW9qZc.js";import"./helpers.yjC6K_2A.js";import"./Row.D0941SYu.js";import"./addons.C_QAj7aO.js";import"./upperFirst.BjBqmCj-.js";import"./_stringToArray.DnK4tKcY.js";import"./toString.Dc7QMRQR.js";import"./license.4E_gI5OR.js";import"./Caret.DMa7g0j7.js";import"./Tooltip.B0brI66q.js";import"./index.Olu2afa7.js";import"./Slide.CdVEnD7S.js";const q={};function X(c,_){return p(),v("div")}const z=k(q,[["render",X]]),n="all-in-one-seo-pack",B=()=>({strings:{customFieldSupport:o("Custom Field Support",n),exclude:o("Exclude Pages/Posts",n),video:o("Video Sitemap",n),description:o("The Video Sitemap generates an XML Sitemap for video content on your site. Search engines use this information to display rich snippet information in search results.",n),extendedDescription:o("The Video Sitemap works in much the same way as the XML Sitemap module, it generates an XML Sitemap specifically for video content on your site. Search engines use this information to display rich snippet information in search results.",n),enableSitemap:o("Enable Sitemap",n),openSitemap:o("Open Video Sitemap",n),noIndexDisplayed:o("Noindexed content will not be displayed in your sitemap.",n),doYou404:o("Do you get a blank sitemap or 404 error?",n),ctaButtonText:o("Unlock Video Sitemaps",n),ctaHeader:R(o("Video Sitemaps is a %1$s Feature",n),"PRO"),linksPerSitemap:o("Links Per Sitemap",n),maxLinks:o("Allows you to specify the maximum number of posts in a sitemap (up to 50,000).",n),enableSitemapIndexes:o("Enable Sitemap Indexes",n)}}),Y={setup(){const{strings:c}=B();return{strings:c,GLOBAL_STRINGS:A,links:C}},components:{CoreBlur:N,CoreSettingsRow:V,SvgExternal:P,BaseRadioToggle:D}},j={class:"aioseo-settings-row aioseo-section-description"},J=["innerHTML"],K={class:"aioseo-sitemap-preview"},Q={class:"aioseo-description"},W=s("br",null,null,-1),Z=["innerHTML"],$={class:"aioseo-description"},ee=["innerHTML"],oe={class:"aioseo-description"},ne=["innerHTML"];function te(c,_,g,e,f,y){const u=i("base-toggle"),d=i("core-settings-row"),h=i("svg-external"),L=i("base-button"),x=i("base-radio-toggle"),G=i("base-input"),I=i("core-blur");return p(),S(I,null,{default:r(()=>[s("div",j,[l(a(e.strings.extendedDescription)+" ",1),s("span",{innerHTML:e.links.getDocLink(e.GLOBAL_STRINGS.learnMore,"videoSitemaps",!0)},null,8,J)]),t(d,{name:e.strings.enableSitemap},{content:r(()=>[t(u,{modelValue:!0})]),_:1},8,["name"]),t(d,{name:e.GLOBAL_STRINGS.preview},{content:r(()=>[s("div",K,[t(L,{size:"medium",type:"blue"},{default:r(()=>[t(h),l(" "+a(e.strings.openSitemap),1)]),_:1})]),s("div",Q,[l(a(e.strings.noIndexDisplayed)+" ",1),W,l(" "+a(e.strings.doYou404)+" ",1),s("span",{innerHTML:e.links.getDocLink(e.GLOBAL_STRINGS.learnMore,"blankSitemap",!0)},null,8,Z)])]),_:1},8,["name"]),t(d,{name:e.strings.enableSitemapIndexes},{content:r(()=>[t(x,{name:"sitemapIndexes",options:[{label:e.GLOBAL_STRINGS.disabled,value:!1,activeClass:"dark"},{label:e.GLOBAL_STRINGS.enabled,value:!0}]},null,8,["options"]),s("div",$,[l(a(e.strings.sitemapIndexes)+" ",1),s("span",{innerHTML:e.links.getDocLink(e.GLOBAL_STRINGS.learnMore,"sitemapIndexes",!0)},null,8,ee)])]),_:1},8,["name"]),t(d,{name:e.strings.linksPerSitemap},{content:r(()=>[t(G,{class:"aioseo-links-per-site",type:"number",size:"medium",min:1,max:5e4}),s("div",oe,[l(a(e.strings.maxLinks)+" ",1),s("span",{innerHTML:e.links.getDocLink(e.GLOBAL_STRINGS.learnMore,"maxLinks",!0)},null,8,ne)])]),_:1},8,["name"])]),_:1})}const ie=k(Y,[["render",te]]),se={setup(){const{strings:c}=B();return{licenseStore:M(),rootStore:w(),links:C,strings:c}},components:{Blur:ie,RequiredPlans:H,CoreCard:O,CoreProBadge:U,Cta:E}},re={class:"aioseo-video-sitemap-lite"};function ae(c,_,g,e,f,y){const u=i("core-pro-badge"),d=i("blur"),h=i("required-plans"),L=i("cta"),x=i("core-card");return p(),v("div",re,[t(x,{slug:"videoSitemap",noSlide:!0},{header:r(()=>[s("span",null,a(e.strings.video),1),t(u)]),default:r(()=>[t(d),t(L,{"feature-list":[e.strings.customFieldSupport,e.strings.exclude],"cta-link":e.links.getPricingUrl("video-sitemap","video-sitemap-upsell"),"button-text":e.strings.ctaButtonText,"learn-more-link":e.links.getUpsellUrl("video-sitemap",null,e.rootStore.isPro?"pricing":"liteUpgrade"),"hide-bonus":!e.licenseStore.isUnlicensed},{"header-text":r(()=>[l(a(e.strings.ctaHeader),1)]),description:r(()=>[t(h,{addon:"aioseo-video-sitemap"}),l(" "+a(e.strings.description),1)]),_:1},8,["feature-list","cta-link","button-text","learn-more-link","hide-bonus"])]),_:1})])}const T=k(se,[["render",ae]]),ce={class:"aioseo-video-sitemap"},Ve={__name:"VideoSitemap",setup(c){const{shouldShowActivate:_,shouldShowLite:g,shouldShowMain:e,shouldShowUpdate:f}=F({addonSlug:"aioseo-video-sitemap"});return(y,u)=>(p(),v("div",ce,[m(e)?(p(),S(m(T),{key:0})):b("",!0),m(f)||m(_)?(p(),S(m(z),{key:1})):b("",!0),m(g)?(p(),S(m(T),{key:2})):b("",!0)]))}};export{Ve as default};