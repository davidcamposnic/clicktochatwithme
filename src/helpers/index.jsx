export const generarId = () => {
  const fecha = Date.now().toString(36);
  const random = Math.random().toString(36).substr(2);
  return fecha + random;
};
