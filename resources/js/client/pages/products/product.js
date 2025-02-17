import React from "react";
import {
    Card,
    Image,
    Text,
    Badge,
    Button,
    Group,
    useMantineTheme,
} from "@mantine/core";
import Rating from "@mui/material/Rating";
import moment from 'moment'
import StarIcon from "@mui/icons-material/Star";
const Product = ({ prod }) => {
    const guestCart = [];
    const {name, price, description, image} = prod;
    const format = (num) => new Intl.NumberFormat().format(num)
    const handleAddToCart = (product) => {
        //if the product is already in the cart, update the quantity
        const { id } = product;

        if (!sessionStorage.getItem("cartIdStore")) {
            sessionStorage.setItem("cartIdStore", JSON.stringify([id]));
            sessionStorage.setItem("cart", JSON.stringify([product]));
        } else {
            if (
                !JSON.parse(sessionStorage.getItem("cartIdStore")).includes(id)
            ) {
                sessionStorage.setItem(
                    "cart",
                    JSON.stringify([
                        ...JSON.parse(sessionStorage.getItem("cart")),
                        product,
                    ])
                );

                sessionStorage.setItem(
                    "cartIdStore",
                    JSON.stringify([
                        ...JSON.parse(sessionStorage.getItem("cartIdStore")),
                        id,
                    ])
                );
            }
            // setOpened(true);
        }
    };
    const addtocart = (product) => {
        const {id} = product;
        guestCart.push(id);
        //make a call to the server to add product to session
        axios.post(`${window.location.origin}/cartsession`, {
            product_id: id
        }).then(function(response) {
            console.log(response.data)
            const {
                message,
                product,
                cart_count
            } = response.data;
            swal({
                title: "Product Added Successfully!",
                text: message,
                icon: "success",
            });
            handleAddToCart(product)
            // document.querySelector('#vicomma-cart-cta').innerHTML = cart_count;
        })
    };
    const theme = useMantineTheme();
    const secondaryColor =
        theme.colorScheme === "dark"
            ? theme.colors.dark[1]
            : theme.colors.gray[7];

    return (
        <>
          <div>
            {/* COMPONENT: PRODUCT CARD */}
            <article key={name} className="shadow-sm rounded bg-white border border-gray-200">
            <div className="flex items-center space-x-4 px-2 py-2">
            <img className="w-10 h-10 rounded-full" src={prod && prod.vendor && prod.vendor.user? prod.vendor.user.image : ""} alt="" />
            <div className="font-medium dark:text-white">
            <a href={"/mall/show/" + prod.id} className="block text-gray-600 hover:text-blue-500">
                <Text
                        weight={'bold'}
                        style={{ overflow: "hidden", textOverflow: "ellipsis" }}
                    >
                        {prod.vendor? prod.vendor.vendor_station : ""}
                    </Text>
                </a>
                <div className="text-sm text-gray-500 dark:text-gray-400">{moment(prod.created_at).fromNow()}</div>
            </div>
            </div>

              <a href="#" className="block relative p-1" style={{
                  width: "",
                  height: "200px",
                  backgroundImage: image && JSON.parse(image)[0]? "https://viccomma-videos.s3.us-east-2.amazonaws.com/product-images/" + JSON.parse(image)[0] :
                  "/img/empty.png",
                  backgroundPosition: "center",
                  background:  `url(${image && JSON.parse(image)[0]? "https://viccomma-videos.s3.us-east-2.amazonaws.com/product-images/" + JSON.parse(image)[0] :
                  "/img/empty.png"}) center`,
                  backgroundSize: "cover",
                  backgroundRepeat: "no-repeat"
              }}>
            
              </a>
              <div className="p-4 border-t border-t-gray-200">
              <span class="bg-green-100 mb-2 text-green-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-green-200 dark:text-green-900">{prod.category.name}</span>
                <h4 className="font-semibold mt-2">${format(price)}</h4>
                <a href={"/mall/show/" + prod.id} className="block text-gray-600 mb-2 mt-2 hover:text-blue-500">
                <Text
                        weight={500}
                        style={{ overflow: "hidden", textOverflow: "ellipsis" }}
                    >
                        {name}
                    </Text>
                </a>
                <Rating
                            name="disabled"
                            value={3}
                            size="large"
                            disabled
                            emptyIcon={<StarIcon fontSize="inherit" />}
                        />
                <div className="mt-3" style={{display: "flex"}}>
                  <button style={{backgroundColor: "#6f3c96"}} onClick={() => addtocart(prod)} className="px-4 py-2 inline-block text-white text-center bg-indigo-600 border border-transparent rounded-md hover:bg-blue-700">
                    Bag it
                  </button>
                  <a className="px-4 py-2 mx-2 inline-block text-blue-600 border border-gray-300 rounded-md hover:bg-gray-100" href={"/mall/show/" + prod.id}>
                <i style={{color: "#6f3c96"}} className="fa fa-eye" />
                </a>

                </div>
              </div>
            </article>
            {/* COMPONENT: PRODUCT CARD //END */}
          </div>
         {/* <div key={name} className="mx-4" style={{ width: 300 }}>
             <Card shadow="sm" p="lg">
                 <Card.Section
                    component="a"
                    href="https://mantine.dev"
                    target="_blank"
                >
                    <Image
                        src={
                            image && JSON.parse(image)[0]? "https://viccomma-videos.s3.us-east-2.amazonaws.com/product-images/" + JSON.parse(image)[0] :
                            "https://vicomma-stagingrevamp.herokuapp.com/img/product.png"
                        }
                        height={160}
                        alt="Norway"
                    />
                </Card.Section>

                <Group
                    position="apart"
                    style={{ marginBottom: 5, marginTop: theme.spacing.sm }}
                >
                    <Text
                        weight={500}
                        style={{ overflow: "hidden", textOverflow: "ellipsis" }}
                    >
                        {name}
                    </Text>
                    <Badge color="pink" variant="light">
                        On Sale
                    </Badge>
                </Group>

                <Text
                    size="sm"
                    style={{ color: secondaryColor, lineHeight: 1.5 }}
                    lineClamp={1}
                    
                >
                    <span dangerouslySetInnerHTML={{__html: description}}></span>
                </Text>
                <Rating
                            name="disabled"
                            value={3}
                            size="large"
                            disabled
                            emptyIcon={<StarIcon fontSize="inherit" />}
                        />
                     <h6 className="mt-2 font-weight-light">{price}</h6>
                <div
                    style={{
                        display: "flex",
                        flexDirection: "row",
                        justifyContent: "space-around",
                    }}
                >
                    <Button
                        variant="light"
                        onClick={() => handleAddToCart(prod)}
                        color="blue"
                        // fullWidth
                        style={{ marginTop: 14 }}
                    >
                        Add to Cart
                    </Button>

                    <Button
                        component="a"
                        href={"/mall/show/" + prod.id}
                        variant="light"
                        color="blue"
                        // fullWidth
                        
                        style={{ marginTop: 14 }}
                    >
                        View More
                    </Button>
                </div>
            </Card>
        </div> */}
        </>
    );
};

export default Product;
