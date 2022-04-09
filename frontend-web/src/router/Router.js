import React, { Component } from "react";
import { BrowserRouter, Route, Routes } from "react-router-dom";

import Login from "../components/general/Login";
import Home from "../components/Home";
import Error from "../components/general/Error";

class Router extends Component {
  render() {
    return (
      <BrowserRouter>
        <Routes path="/" element={<Home />}>
          <Route index element={<Login />} />
          <Route path="*" element={<Error />} />
        </Routes>
      </BrowserRouter>
    );
  }
}

export default Router;
