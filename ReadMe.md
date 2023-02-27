# Tirta Medical Centre

## API Spec

### Authentication : 
    Authorization : API-KEY

### Create Category :
    Endpoint : [POST] /api/categories
    Request Body : 
        {
            "name" : "category name"
        }
    
    Response Success
        {
        "data" : {
            "id" : "uuid",
            "name" : "Category Name",
            "createdAt" : 1234556 // epoch time milis
            }
        }

    HTTP Status : 400 Bad Request
    Response error
        {
        "errors" : {
            "name" : [
                    "name is empty",
                    "name length must not more than 255 characters"
                ]
            }
        }

### Create Product :
    Endpoint : [POST] /api/products
    Request Body : 
        {
            "sku" : "SKU"
            "name" : "Product Name",
            "price" : 1000000,
            "stock" : 100,
            "categoryId" : "categoryId"
        }
    
    Response Success
       {
        "data" : {
                "id" : "uuid",
                "sku" : "sku"
                "name" : "Product Name",
                "price" : 1000000,
                "stock" : 100,
                "category" : {
                    "id" : "uuid",
                    "name" : "Category Name"
                },
                "createdAt" : 1234556 // epoch time milis
            }
        }

    HTTP Status : 400 Bad Request
    Response error
        {
            "errors" : {
                "sku" : [
                    "sku is empty",
                    "sku is unique"
                ],
                "name" : [
                    "name is empty",
                    "name length must not more than 255
                    characters”
                ],
                "price" : [
                    "price must not negative"
                ],
            }
        }

### Search API :
    Endpoint : [GET] /api/search
    Request query param : 
            - sku : filter by sku, support multiple parameter
            - name : filter by name (LIKE), support multiple parameters
            - price.start : filter by start price
            - price.end : filter by end price
            - stock.start : filter by start stock
            - stock.end : filter by end stock
            - category.id : filter by category.id, support multiple parameters
            - category.name : filter by category.name support multiple parameters

    EXAMPLE Request query param : 
        - Search products with sku in (1, 2, 3) : /api/search?sku=1&sku=2&sku=3
        - Search products with name like a or b or c : /api/search?name=a&name=b&name=c
        - Search products with price >= 100 and <= 1000 : /api/search?price.start=100&price.end=1000
        - Search product in categories (1, 2, 3) : /api/search?category.id=1&category.id=2&category.id=3

    
    Response Success
    {
        "data" :  [
                    {
                        "id" : "uuid",
                        "sku" : "sku"
                        "name" : "Product Name",
                        "price" : 1000000,
                        "stock" : 100,
                        "category" : {
                            "id" : "uuid",
                            "name" : "Category Name"
                        }
                    "createdAt" : 1234556 // epoch time milis
                    },
                    {
                        "id" : "uuid",
                        "sku" : "sku"
                        "name" : "Product Name",
                        "price" : 1000000,
                        "stock" : 100,
                        "category" : {
                            "id" : "uuid",
                            "name" : "Category Name"
                        }
                    "createdAt" : 1234556 // epoch time milis
                    }
                ],

        "paging" : {
                "size" : 10, // page size
                "total" : 100, // total page,
                "current" : 1 // current page
            }
    }   
