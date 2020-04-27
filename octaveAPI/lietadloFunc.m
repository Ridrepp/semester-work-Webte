function lietadloFunc(func_arg)

pkg load control;
A = [-0.313 56.7 0; -0.0139 -0.426 0; 0 56.7 0];
B = [0.232; 0.0203; 0];
C = [0 0 1];
D = [0];

p = 2;
K = lqr(A,B,p*C'*C,1);
N = -inv(C(1,:)*inv(A-B*K)*B);

sys = ss(A-B*K, B*N, C, D);

t = 0:0.1:40;

func_arg = str2double(func_arg);
r = func_arg;

initAlfa=0;
initQ=0;
initTheta=0;
[y,t,x]=lsim(sys,r*ones(size(t)),t,[initAlfa;initQ;initTheta]);
plot(t,y)

r = func_arg;

[y,t,x]=lsim(sys,r*ones(size(t)),t,x(size(x,1),:));
%plot(t,y)

%plot(t,r*ones(size(t))*N-x*K')

output1 = x(:,3);
save lietadlo_output_1.mat output1;
output2 = r*ones(size(t))*N-x*K';
save lietadlo_output_2.mat output2;
endfunction