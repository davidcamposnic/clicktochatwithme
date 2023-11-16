import { useState } from "react";
import { Dashboard } from "./api";

const dashboardCollection = new Dashboard();

const App = () => {
  const { create } = dashboardCollection;

  const [name, setName] = useState("");

  const handleSubmit = async (e) => {
    e.preventDefault();
    await create(name);
  };

  return (
    <div>
      <form onSubmit={handleSubmit}>
        <label htmlFor="name">Name</label>
        <input
          type="text"
          name="name"
          id="name"
          value={name}
          onChange={(newValue) => setName(newValue.target.value)}
        />
        <input type="submit" value="Enviar" />
      </form>
    </div>
  );
};

export default App;
