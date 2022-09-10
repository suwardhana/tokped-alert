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

$response = curl_exec($curl);

curl_close($curl);
// echo $response;
$BOT_TOKEN = $_ENV['BOT_TOKEN'];
$id = $_ENV["USER_ID"];

$bot = new Client($BOT_TOKEN);
$response_array = json_decode($response, true);
$product_1 = $response_array[0]["data"]["ace_search_product_v4"]["data"]["products"][0];
$price_product_1 = str_replace(".", "", $product_1["price"]);
$price_product_1 = str_replace("Rp", "", $price_product_1);
print('<pre>' . print_r($product_1, true) . '</pre>');
if ($price_product_1 < 4700000) {
  $bot->sendMessage($id, "Harga Produk Turun\nHarga Sekarang : " . $product_1["price"]);
  $bot->sendMessage($id, "Link : " . $product_1["url"]);
}
