import React from "react";

const Error = (props) => {
  return (
    <div className="d-flex flex-row justify-content-between align-items-center Error">
      <div className="col-md-2 col-sm-2 col-xs-2"></div>
      <div className="col-md-8 col-sm-8 col-xs-8">
        <h1>Error, la página a la que desea acceder no existe</h1>
        <h2>Por favor verifique el URL que está digitando</h2>
      </div>
      <div className="col-md-2 col-sm-2 col-xs-2"></div>
    </div>
  );
};

export default Error;
