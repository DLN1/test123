import React, { useEffect, useState } from 'react';
import { Card, ListGroup, ListGroupItem, Row, Col, Container } from 'react-bootstrap';
import { GoogleMap, LoadScript, Marker } from '@react-google-maps/api';

import Moment from 'react-moment';

function RouteCard() {
    const [routes, setRoutes] = useState([]);
    const [loading, setLoading] = useState(true);

    useEffect(async () => {
        const response = await fetch("http://localhost:3000/api/api.php/");
        const data = await response.json();


        setRoutes(data)
        setLoading(false)
    }, []);


    const mapStyles = {
        height: "450px",
        width: "100%"
    };

    const defaultCenter = {
        lat: 57.634591, lng: 14.063240
    }




    return (
        <div>
            {loading ? <div className="error">...Loading</div> :

                <div className="grid">
                    {routes.slice(0, 30).map((route) => (
                        <Container>
                            <Row>
                                <Col className="mt-5 col-12">
                                    <LoadScript googleMapsApiKey='AIzaSyA0HUQC2wxhzInxC0exdCJ3TlaIrHp7wDU'>
                                        <Card key={route.routeId}>
                                            <Card.Body>
                                                <h4>
                                                    Reseinformation
                                                </h4>
                                                <h3>{route.routeType}</h3>
                                                <Card.Title style={{ fontSize: '14px' }}>Registreringsnummer:{route.licensePlate}</Card.Title>


                                                <GoogleMap
                                                    mapContainerStyle={mapStyles}
                                                    zoom={7}
                                                    center={defaultCenter}>


                                                    {routes.location}
                                                    <Marker label={"Start"} key={route.routeId} position={{ lat: parseFloat(route.firstLat), lng: parseFloat(route.firstLon) }}>

                                                    </Marker>
                                                    <Marker label={"Slut"} key={route.routeId} position={{ lat: parseFloat(route.lastLat), lng: parseFloat(route.lastLon) }}></Marker>

                                                </GoogleMap>


                                            </Card.Body>
                                            <Row>
                                                <Col className="d-flex row">
                                                    <ListGroup className="list-group-flush">
                                                        <ListGroupItem>Körsträcka: {parseFloat(route.distance).toFixed(2)}km</ListGroupItem>
                                                        <ListGroupItem>tid för start: <Moment parse="YYYY-MM-DD HH:mm:ss" format="YYYY/MM/DD/hh:mm:ss">{route.timeStart}</Moment></ListGroupItem>
                                                        <ListGroupItem>kostnad: {parseFloat(route.cost).toFixed(2)} SEK</ListGroupItem>
                                                    </ListGroup>
                                                </Col>
                                                <Col>
                                                    <ListGroup className="list-group-flush">
                                                        <ListGroupItem>resetid: {parseFloat(route.travelTime / 60).toFixed(2)} minuter</ListGroupItem>
                                                        <ListGroupItem>tid för avslut: <Moment parse="YYYY-MM-DD HH:mm:ss" format="YYYY/MM/DD/HH:mm:ss">{route.timeEnd}</Moment></ListGroupItem>
                                                        <ListGroupItem>liter: {parseFloat(route.liters).toFixed(2)}L</ListGroupItem>
                                                    </ListGroup>
                                                </Col>
                                            </Row>
                                        </Card>
                                    </LoadScript>
                                </Col>
                            </Row>
                        </Container>
                    ))}
                </div>
            }

        </div>

    )

}

export default RouteCard

