<?php
include("./vendor/autoload.php");

use TelegramBot\Api\Client;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://gql.tokopedia.com/graphql/SearchProductQueryV4',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => '[{"operationName":"SearchProductQueryV4","variables":{"params":"device=desktop&navsource=&ob=3&origin_filter=sort_price&page=1&pmin=3900000&q=12700f&related=true&rf=true&rows=60&safe_search=false&scheme=https&shipping=&shop_tier=2%233%231&source=search&srp_component_id=02.01.00.00&srp_page_id=&srp_page_title=&st=product&start=0&topads_bucket=true&unique_id=a3841973e2e8b3183c99250e2e392646&user_addressId=&user_cityId=176&user_districtId=2274&user_id=&user_lat=&user_long=&user_postCode=&user_warehouseId=12210375&variants="},"query":"query SearchProductQueryV4($params: String!) {\\n  ace_search_product_v4(params: $params) {\\n    header {\\n      totalData\\n      totalDataText\\n      processTime\\n      responseCode\\n      errorMessage\\n      additionalParams\\n      keywordProcess\\n      componentId\\n      __typename\\n    }\\n    data {\\n      banner {\\n        position\\n        text\\n        imageUrl\\n        url\\n        componentId\\n        trackingOption\\n        __typename\\n      }\\n      backendFilters\\n      isQuerySafe\\n      ticker {\\n        text\\n        query\\n        typeId\\n        componentId\\n        trackingOption\\n        __typename\\n      }\\n      redirection {\\n        redirectUrl\\n        departmentId\\n        __typename\\n      }\\n      related {\\n        position\\n        trackingOption\\n        relatedKeyword\\n        otherRelated {\\n          keyword\\n          url\\n          product {\\n            id\\n            name\\n            price\\n            imageUrl\\n            rating\\n            countReview\\n            url\\n            priceStr\\n            wishlist\\n            shop {\\n              city\\n              isOfficial\\n              isPowerBadge\\n              __typename\\n            }\\n            ads {\\n              adsId: id\\n              productClickUrl\\n              productWishlistUrl\\n              shopClickUrl\\n              productViewUrl\\n              __typename\\n            }\\n            badges {\\n              title\\n              imageUrl\\n              show\\n              __typename\\n            }\\n            ratingAverage\\n            labelGroups {\\n              position\\n              type\\n              title\\n              url\\n              __typename\\n            }\\n            componentId\\n            __typename\\n          }\\n          componentId\\n          __typename\\n        }\\n        __typename\\n      }\\n      suggestion {\\n        currentKeyword\\n        suggestion\\n        suggestionCount\\n        instead\\n        insteadCount\\n        query\\n        text\\n        componentId\\n        trackingOption\\n        __typename\\n      }\\n      products {\\n        id\\n        name\\n        ads {\\n          adsId: id\\n          productClickUrl\\n          productWishlistUrl\\n          productViewUrl\\n          __typename\\n        }\\n        badges {\\n          title\\n          imageUrl\\n          show\\n          __typename\\n        }\\n        category: departmentId\\n        categoryBreadcrumb\\n        categoryId\\n        categoryName\\n        countReview\\n        customVideoURL\\n        discountPercentage\\n        gaKey\\n        imageUrl\\n        labelGroups {\\n          position\\n          title\\n          type\\n          url\\n          __typename\\n        }\\n        originalPrice\\n        price\\n        priceRange\\n        rating\\n        ratingAverage\\n        shop {\\n          shopId: id\\n          name\\n          url\\n          city\\n          isOfficial\\n          isPowerBadge\\n          __typename\\n        }\\n        url\\n        wishlist\\n        sourceEngine: source_engine\\n        __typename\\n      }\\n      violation {\\n        headerText\\n        descriptionText\\n        imageURL\\n        ctaURL\\n        ctaApplink\\n        buttonText\\n        buttonType\\n        __typename\\n      }\\n      __typename\\n    }\\n    __typename\\n  }\\n}\\n"}]',
  CURLOPT_HTTPHEADER => array(
    'authority: gql.tokopedia.com',
    'accept: */*',
    'accept-language: en-US,en;q=0.9',
    'cache-control: no-cache',
    'content-type: application/json',
    'cookie: bm_sz=83CB839B6DCE6BCFBD5C842DE01A1978~YAAQZOUcuNnbu/+CAQAADZ4mIxE/n9o+jvJK2EkFq49R+DMe5zrdAQ5I9jhN/wQF0a2Ni5C6mzMW8nu/N8bLP5MkXxh8ul6217C68+3/fRAFWlK11/MLMCnejIiDkie6bt0AULc0ZcnihE6t8lWNTcldyQXhj3HZUW8fUsCW72Do1agS+wQOwlvePpebY0dFBv4ZBXdUyVpJWQvzhkxk+oAtzQBRq33k/O/NyYSocx1FjEXx1aJm8gLNa2Rg/4ERLoDEGszsu8O+ZOfGEW9UDxdTnAlnCljn6SKJkt4PeAo8d0SXxSk=~3229251~4601392; _abck=E1686201BFB3CFCB103E8163A7038D8B~0~YAAQZOUcuOfbu/+CAQAAn58mIwiqf1Kj373A2mnjvIeAGWUAHBoa+ns5nJw7ZK7zti+T3LlpmKTkDyazjQMnZj3qhKRL4DI5PMEQwuju2ttG6FfqbUL9yajhV1DeuA3ynkROmZeb4/MkTRUObeYfABWJ76qDMtH7x+r3Kp17OFMjJzs4j88dgEAfN1cAInnfH6BLOEad+dEwqlPYDUVcQHGdraKMxFzF4KgLZC7nhm3S98Swa7Cd/GjpbHNkWYHZi3TCRQle1sQX6S+z6Dtj9+JbJ7iZcSLS9uEGwEGnPciYfgXs4KWNKHdQ2S79t6JIZrzN5MBHAbyWmC9E7jx0LuGYcecXum5q5qjFz8OWwf3sFbQ8gtSGePdNAjaREKzKc2PZjl7mCBZo45lXzfQLt6HHTOQ8Xm0S~-1~-1~-1; _gcl_au=1.1.469289144.1662742077; _SID_Tokopedia_=fhSQHd7Yd4UgR5y0rOXC68rsgTR7kjTLMt0pnX4cuoKstVoHJqtznCji6C02LDDd_VGDaGN8nUoRrvHm6JwtPLeJGElKWH0yP2lUKDnsnpfdovj2z-iL5WZd4x5cG26_; DID=770e7f3472e5c84dcee5c7c9efe40f280327dc9b46064440388af87b1545ae822aeb7d4c3d922ac6217b236b6f27ba30; DID_JS=NzcwZTdmMzQ3MmU1Yzg0ZGNlZTVjN2M5ZWZlNDBmMjgwMzI3ZGM5YjQ2MDY0NDQwMzg4YWY4N2IxNTQ1YWU4MjJhZWI3ZDRjM2Q5MjJhYzYyMTdiMjM2YjZmMjdiYTMw47DEQpj8HBSa+/TImW+5JCeuQeRkm5NMpJWZG3hSuFU=; _UUID_NONLOGIN_=a3841973e2e8b3183c99250e2e392646; hfv_banner=true; _ga=GA1.2.1853826406.1662742077; _gid=GA1.2.445677243.1662742078; _dc_gtm_UA-126956641-6=1; _UUID_CAS_=52e2859e-96a2-4b33-8218-387ae85c42a7; ak_bmsc=568E15CD509DE4EDE386C84376286ACA~000000000000000000000000000000~YAAQZOUcuOrbu/+CAQAA76EmIxEEIfXyKOU26h6optglJi0jOy14VYDiVTk599hI7OTSRhFsXTKhAHaZfewrZWJlrjXoGSgH3loYkJvkhpAOcuNQVCkF+cnGTXwsRHzMnQQ6dYvXgoRPqF+T1BLUdrGkOZvAT8QrucXf/yCEOurdSW98D/CuuQQGPon2wkHH73poi2WsH+VA9YSEDno9OMA2CrKLYsfx+9XauGdDK/0Fy7bB579PaEnPlQcl3LKNkG0FShan4gHpqktk/pKFIj/lxFFcEHcB0fbEIZRtcakly65IpRBJ+zglFhTfNBVG127/+bGRQOZVAD6WGmZbMEiQMz/3sEXv5aVPClR+2chkQ9jG5zu+GBxl+HJmiW8RPqVzJHa2Ll0qB6AVt9tQLSfqKVfYrZiZJnt5zA8RhxJMkM7LdoYip14q7W5A7Zmxj22y7pZtbalglcsMdSq6WicmSucOaG0C21vtBxJ7l/1pXU+W/mz+Osx+jQrwaHY=; _CASE_=752c6a476a2c343c3c393a222c6f476a2c343e222c626c622c342c446f656f7c7a6f2e5e7b7d6f7a2c222c6d476a2c343f3938222c626160692c342c2c222c626f7a2c342c2c222c7e4d612c342c2c222c79476a2c343f3c3c3f3e3d393b222c7d476a2c343f3f3b3d3e3b393d222c7d5a777e6b2c342c3c662c222c79667d2c342c5575522c796f7c6b66617b7d6b51676a522c343f3c3c3f3e3d393b22522c7d6b7c78676d6b517a777e6b522c34522c3c66522c22522c51517a777e6b606f636b522c34522c596f7c6b66617b7d6b7d522c732275522c796f7c6b66617b7d6b51676a522c343e22522c7d6b7c78676d6b517a777e6b522c34522c3f3b63522c22522c51517a777e6b606f636b522c34522c596f7c6b66617b7d6b7d522c73532c222c625b7e6a2c342c3c3e3c3c233e37233e375a3c3d343a39343b39253e39343e3e2c73; AMP_TOKEN=%24NOT_FOUND; _dc_gtm_UA-9801603-1=1; _gat_UA-9801603-1=1; _jxx=291bfd80-305f-11ed-bacb-a1292e0cbffd; _jxxs=1662742078-291bfd80-305f-11ed-bacb-a1292e0cbffd; _jx=291bfd80-305f-11ed-bacb-a1292e0cbffd; _jxs=1662742078-291bfd80-305f-11ed-bacb-a1292e0cbffd; __asc=a82eca8d1832326b3c915298cc5; __auc=a82eca8d1832326b3c915298cc5; _ga_70947XW48P=GS1.1.1662742077.1.1.1662742103.34.0.0; _abck=E1686201BFB3CFCB103E8163A7038D8B~-1~YAAQxHUyF9dFYReDAQAAZggoIwgV+ZvSxxf/f4CYxQZvx0HJmrc3ZQLRwy6E065CjDCBFvl6hNn4gAtC8hn0nxSa8tHHgF8+LDqOUP7weMeI6fhLPke6zjNQnRwVhTj3iIPAhSJod6ARrJauWbxMgKSBfmSF8tmvCI0RQhR4RmXYw9qr/L2wxnBXkfulpdxXsOYS74uxZxZi7FvxG/uyJkjL7Tyz/FHojmC7sVJ/is6fxOftj76/7NAo2DiUb73h2q7AeVxXjcuU0VM4qRfl9jOxGIekaDNja+Vokob902Nn2WShUM7r+GobAFl8EK5ZFRI2aX3u5bIzzuFOE5LSu3ai2AnvQmMn09+5ut/Y+nCu8I2KH2dpM+U77fzE79x0GFFlsE01zXOh7S9F1Jne28HjiQmdTE5z~0~-1~-1',
    'dnt: 1',
    'origin: https://www.tokopedia.com',
    'pragma: no-cache',
    'referer: https://www.tokopedia.com/search?navsource=&ob=3&origin_filter=sort_price&pmin=3900000&rf=true&shop_tier=2%233%231&srp_component_id=02.01.00.00&srp_page_id=&srp_page_title=&st=product&q=12700f',
    'sec-ch-ua: "Google Chrome";v="105", "Not)A;Brand";v="8", "Chromium";v="105"',
    'sec-ch-ua-mobile: ?0',
    'sec-ch-ua-platform: "macOS"',
    'sec-fetch-dest: empty',
    'sec-fetch-mode: cors',
    'sec-fetch-site: same-site',
    'tkpd-userid: 0',
    'user-agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/105.0.0.0 Safari/537.36',
    'x-device: desktop-0.0',
    'x-source: tokopedia-lite',
    'x-tkpd-lite-service: zeus',
    'x-version: d72d26f'
  ),
));

$response_intel = curl_exec($curl);

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://gql.tokopedia.com/graphql/SearchProductQueryV4',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => '[{"operationName":"SearchProductQueryV4","variables":{"params":"device=desktop&navsource=&ob=3&page=1&q=amd%205900x&related=true&rows=60&safe_search=false&scheme=https&shipping=&shop_tier=2&source=search&srp_component_id=02.01.00.00&srp_page_id=&srp_page_title=&st=product&start=0&topads_bucket=true&unique_id=7bdad645b5b6d6adc585dfa7405a9630&user_addressId=93035451&user_cityId=115&user_districtId=1238&user_id=76627748&user_lat=-2.990189&user_long=104.721965&user_postCode=30138&user_warehouseId=0&variants="},"query":"query SearchProductQueryV4($params: String!) {\\n  ace_search_product_v4(params: $params) {\\n    header {\\n      totalData\\n      totalDataText\\n      processTime\\n      responseCode\\n      errorMessage\\n      additionalParams\\n      keywordProcess\\n      componentId\\n      __typename\\n    }\\n    data {\\n      banner {\\n        position\\n        text\\n        imageUrl\\n        url\\n        componentId\\n        trackingOption\\n        __typename\\n      }\\n      backendFilters\\n      isQuerySafe\\n      ticker {\\n        text\\n        query\\n        typeId\\n        componentId\\n        trackingOption\\n        __typename\\n      }\\n      redirection {\\n        redirectUrl\\n        departmentId\\n        __typename\\n      }\\n      related {\\n        position\\n        trackingOption\\n        relatedKeyword\\n        otherRelated {\\n          keyword\\n          url\\n          product {\\n            id\\n            name\\n            price\\n            imageUrl\\n            rating\\n            countReview\\n            url\\n            priceStr\\n            wishlist\\n            shop {\\n              city\\n              isOfficial\\n              isPowerBadge\\n              __typename\\n            }\\n            ads {\\n              adsId: id\\n              productClickUrl\\n              productWishlistUrl\\n              shopClickUrl\\n              productViewUrl\\n              __typename\\n            }\\n            badges {\\n              title\\n              imageUrl\\n              show\\n              __typename\\n            }\\n            ratingAverage\\n            labelGroups {\\n              position\\n              type\\n              title\\n              url\\n              __typename\\n            }\\n            componentId\\n            __typename\\n          }\\n          componentId\\n          __typename\\n        }\\n        __typename\\n      }\\n      suggestion {\\n        currentKeyword\\n        suggestion\\n        suggestionCount\\n        instead\\n        insteadCount\\n        query\\n        text\\n        componentId\\n        trackingOption\\n        __typename\\n      }\\n      products {\\n        id\\n        name\\n        ads {\\n          adsId: id\\n          productClickUrl\\n          productWishlistUrl\\n          productViewUrl\\n          __typename\\n        }\\n        badges {\\n          title\\n          imageUrl\\n          show\\n          __typename\\n        }\\n        category: departmentId\\n        categoryBreadcrumb\\n        categoryId\\n        categoryName\\n        countReview\\n        customVideoURL\\n        discountPercentage\\n        gaKey\\n        imageUrl\\n        labelGroups {\\n          position\\n          title\\n          type\\n          url\\n          __typename\\n        }\\n        originalPrice\\n        price\\n        priceRange\\n        rating\\n        ratingAverage\\n        shop {\\n          shopId: id\\n          name\\n          url\\n          city\\n          isOfficial\\n          isPowerBadge\\n          __typename\\n        }\\n        url\\n        wishlist\\n        sourceEngine: source_engine\\n        __typename\\n      }\\n      violation {\\n        headerText\\n        descriptionText\\n        imageURL\\n        ctaURL\\n        ctaApplink\\n        buttonText\\n        buttonType\\n        __typename\\n      }\\n      __typename\\n    }\\n    __typename\\n  }\\n}\\n"}]',
  CURLOPT_HTTPHEADER => array(
    'authority: gql.tokopedia.com',
    'accept: */*',
    'accept-language: en-US,en;q=0.9',
    'cache-control: no-cache',
    'content-type: application/json',
    'cookie: _SID_Tokopedia_=4wibgy0ZL1cKxhIpzRqD0lSFwM1vR5u2vOiMNtCxy5KZLOXHEF4b0mrg77kMPBlBEkz0r_8cB83QCQ7EDWRKxATqhAmfYpSc40__tA6Q7o7uOn4WE-Tuf5WDZuIg9Roz; DID=cefde559b12385500c54bef896b9ad5643346eb38be3ebf963990621a0ea14bf8a6a9c3d6a6e73153ed2077c3396a361; DID_JS=Y2VmZGU1NTliMTIzODU1MDBjNTRiZWY4OTZiOWFkNTY0MzM0NmViMzhiZTNlYmY5NjM5OTA2MjFhMGVhMTRiZjhhNmE5YzNkNmE2ZTczMTUzZWQyMDc3YzMzOTZhMzYx47DEQpj8HBSa+/TImW+5JCeuQeRkm5NMpJWZG3hSuFU=; _UUID_NONLOGIN_=69de4b12ab2d2e816c87a9387a710678; hfv_banner=true; __auc=d6da157e17a9f1c5333c1c91632; l=1; aus=1; _fbp=fb.1.1626168069953.759368451; lasty=8; TOPRTK=X1UzdN1FQj-dIuNk3lfDnw; _fbc=fb.1.1639060966469.IwAR1Pt2wLT6zkla3pNXrj2omXRql8qIXWQtfACyZwnEtt0Q45YnUocTheEoc; _UUID_CAS_=bed0d528-a85c-4b5f-af3f-2dd02be0a59f; _CASE_=277e3815387e666d6e6f64707e3d15387e66656f6c6f6968696d707e303e307e667e0e29313d347c0f292b3d2e38343d323d7e707e3f15387e666d6d69707e3033323b7e667e6d6c68726b6e6d656a697e707e303d287e667e716e7265656c6d64657e707e2c1f337e667e6f6c6d6f647e707e2b15387e666c707e2f15387e666d6d696f6c696b6f21; _tt_enable_cookie=1; _ttp=037f8e8c-568d-459a-b921-11b6c7b8d845; _gcl_au=1.1.1651865055.1657346679; _jxx=28075eb0-07da-11ed-8aec-01a474ae2dc4; _jx=28075eb0-07da-11ed-8aec-01a474ae2dc4; cto_bundle=fKV2sl91MFQ2VHhQTFBDd0tZbWRISGslMkJ4ZHVTRDYlMkZ6Z3Y3Z3lhR1g2TWhoRDRoVSUyRmdyMlhEbkR6aUUyJTJCb1VzcGJRckt1TUloZVJOU2FnU004JTJGTVlycEJrbXJSczBDTkJIUnRRRVdYNGFRNHFDR0pNVXRveVQxRXpsWVo0UnRFeG9MbTFvR1l1b0F0Z09teHJLWGJabFJIU1Z3JTNEJTNE; _gid=GA1.2.785155581.1663042980; tuid=76627748; uidh=LS6yCU7ZrscdTM7PRkbiBYywn/g9lMoJtXhGk8jLKtw=; uide=Qpf7wz4qLCb7hSQjRv7GHGCN1w64/6ARf2lc4wSOO4tA4zip; ak_bmsc=B9554FB44E7A0460F15C1A7FB9D64CA5~000000000000000000000000000000~YAAQVu84F8JdLUCDAQAAHGUnQhFxInqfyiaa4Cly1LwW03/osxLFnG6SUDuBJ7aCR5FMgJhWNodB4ShIovPPDwTCJ2QNrAWynwIBnaISMrLX8If5nw5gIl4TMUOwjlfDZTL1pAnqh4sklifaJIwzIHX74PiRaporlShoL9ESzcjWBUd2pfTr00v50Cphy9rYHVmHDi4aRX6Aez5uv2ypDsBpa4PA+NCWuZpO7IGIN61EDPze0/IHUrfZVB2HkewyuXnEw/ouZ7YVQtxArNhUeerqv2/pTeITMnsHzyItIwl6Oi+Pa6PEzi454IG0EyAxEhhOgg9Nol4hodk26XyolKDCGk4AdqWzGJP6Z1sq47tvlXekOkshj9nIuw5sBp5oLCwAjhBZbBWtP3I/FNNiDVt+cafgQjjrfGWuNHFpO/wUA/I9A3ZoAUhYYDf1GBzesM64ol36Z0j+DYMYzJ80ASF22dVtCigvVIKR8WMyD9yjdBwQ6dnJgzWZNwBrNw==; _jxxs=1663262221-28075eb0-07da-11ed-8aec-01a474ae2dc4; _jxs=1663262221-28075eb0-07da-11ed-8aec-01a474ae2dc4; AMP_TOKEN=%24NOT_FOUND; __asc=be2cb4bc18342277fac0ce757fa; NR_SID=NRl83bdy99v5ocry; bm_sz=6E1F37983F086D05525733759C45D450~YAAQVu84F5xsLUCDAQAAgt0pQhHRYkiJPhMPAipK8DnhPclc3DL4DDcqphHaqDL8xfK5UaMppATVIgchr916iNOmRtaLHV4RWDpVB640Lb0T+2npZ533G21K/Pud8jK+x9WtH3LYbbM/Rqj/pjjAFgHBTwJwbi47ztJrRYnOXynrIYKPMq6Ml/RANuY1lXgDqWfaMbEaMj3jCqq9LLs1Nre8FTPKcQTThcbQCJPHGEnXWzZuBKw1PnOhVkAW06FMAnZ0wrQA/kYHW/0/6L+0Z/E6u9ZxR1vli6BsapWKKakVneXAW/vzCj9/FlfSj9q2J3pPhDwmKgs9KQxQsfE=~4469816~4469810; bm_sv=51BF96E853CD9CCFAD39DFC5C8EE21F7~YAAQVu84FxyGLUCDAQAAFnwuQhESGDVEJFLlwi9Si4FnIodu1G6B4R3QPq1ukSS0uFpoJdFMUStbGOAlebQpoApVSte8jcv7R84URC9y6p0JB99v3DGZoGNy8mH/kxk1TMIVWklZ7frF+KQAQdsD9EQDix9/gZce2gmpvfLT+hENMqQ6ZOwXfeTPhj2yo/U70RsEsggJfS1Tx1jkTgq4/zKa1omDHEGeVNekYBS8bV+wxrxADiJANDntSKNi9PBUnLcJ~1; _gat_UA-9801603-1=1; _dc_gtm_UA-126956641-6=1; _ga=GA1.2.1802965914.1626167067; _dc_gtm_UA-9801603-1=1; webauthn-session=24ffb4c8-97ee-4e04-b062-151a35598958; _abck=72C255616AC5D87E1B9D4489544C36F1~0~YAAQte84F+P08DiDAQAARZNLQgiOAJzSJn/1L+jr4el1SrtP5FOq2FI37+bQb3PjHmlPIquUSt57vScHsCHb6A7wzWn0jYzmoNhSAKB6VLjNHZaDEzKtUTFZaMJdnMrq+FBmyUxyHyuWm+wmyL/99NviU20BDIY+DfK6nVCw+Fd4/V6o7n2UDOQg9XoPPwNvnJnO4otpwdD3KCvVi32ETpehEHM64s3G/D3qGPihMU2wgFbCMKF3N55o1/W7RynoCC4CHLv8LRiiRETKxXNir0/6WBr7/IxaRL2Cjeil6/2Hf3y3h6G0NjHTIMNCTSs1r3m+1r+EKRiocQUk2tkQ0ohAl5P/xB5vjTGC48EL9nYGuKPRvoQW5adZlu+hKg==~-1~-1~-1; _ga_70947XW48P=GS1.1.1663262221.564.1.1663264605.31.0.0; _abck=72C255616AC5D87E1B9D4489544C36F1~-1~YAAQxHUyF4Vqz0CDAQAAlW1MQghSRIVUAhOn9gGYrBAliIlae401kMsCkwIqgYbLQr3oNOFDpo8XAzFGEHfYFKkikaWvBFgZAMStBuD+eqh/P4YlLKgxeHs/6q1QpUXDYZ9yyV7BzryzwMeyRqX7plVFjNTUdu6pUhhhJfN33iEK3AjHhdBX9aR/hhJSJ7E2mMxEDLuI6BAmddhNND7NXHvUcHy+qTPq+xbQ9u4dyn62uw/KmTw/f3X+saMdJ6o21jnd5Ih9onlPJbrPGNMTevSKqmhW5Xsj6XQUB1qogmCWgrWfOtlpckkQlycRftRFUz/CfB4rI9n36685NLtoKti8aNgX6bkT63pGM5Xo6wr6sorEnVbAl1X1RbiCXw==~0~-1~-1',
    'dnt: 1',
    'origin: https://www.tokopedia.com',
    'pragma: no-cache',
    'referer: https://www.tokopedia.com/search?navsource=&ob=3&shop_tier=2&srp_component_id=02.01.00.00&srp_page_id=&srp_page_title=&st=product&q=amd%205900x',
    'sec-ch-ua: "Google Chrome";v="105", "Not)A;Brand";v="8", "Chromium";v="105"',
    'sec-ch-ua-mobile: ?0',
    'sec-ch-ua-platform: "macOS"',
    'sec-fetch-dest: empty',
    'sec-fetch-mode: cors',
    'sec-fetch-site: same-site',
    'tkpd-userid: 76627748',
    'user-agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/105.0.0.0 Safari/537.36',
    'x-device: desktop-0.0',
    'x-source: tokopedia-lite',
    'x-tkpd-lite-service: zeus',
    'x-version: e9550a2'
  ),
));

$response_amd = curl_exec($curl);

curl_close($curl);
// echo $response;
$BOT_TOKEN = $_ENV['BOT_TOKEN'];
$id = $_ENV["USER_ID"];

$bot = new Client($BOT_TOKEN);
$response_intel_array = json_decode($response_intel, true);
$product_intel = $response_intel_array[0]["data"]["ace_search_product_v4"]["data"]["products"][0];
$price_product_intel = str_replace(".", "", $product_intel["price"]);
$price_product_intel = str_replace("Rp", "", $price_product_intel);
print('<pre>' . print_r($product_intel, true) . '</pre>');
if ($price_product_intel < 4700000) {
  $bot->sendMessage($id, "Harga Produk Turun\nHarga Sekarang : " . $product_intel["price"]);
  $bot->sendMessage($id, "Link : " . $product_intel["url"]);
}

$response_amd_array = json_decode($response_amd, true);
$product_amd = $response_amd_array[0]["data"]["ace_search_product_v4"]["data"]["products"][0];
$price_product_amd = str_replace(".", "", $product_amd["price"]);
$price_product_amd = str_replace("Rp", "", $price_product_amd);
print('<pre>' . print_r($product_amd, true) . '</pre>');
if ($price_product_amd < 5900000) {
  $bot->sendMessage($id, "Harga 5900x Turun\nHarga Sekarang : " . $product_amd["price"]);
  $bot->sendMessage($id, "Link : " . $product_amd["url"]);
}
