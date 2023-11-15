import { useState } from "react";

const App = () => {
  const [counter, setCounter] = useState(0);
  return (
    <div>
      <h1>React</h1>
      <button onClick={() => setCounter(counter + 1)}>Click to me</button>
      <p>The counter is: {counter}</p>
    </div>
  );
};

export default App;
